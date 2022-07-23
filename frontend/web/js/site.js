new WOW().init();

// function copyToClipboard(content, successMsg = 'Скопировано', errorMsg = 'Ошибка') {
    // var aux = document.createElement('div');
    // aux.setAttribute('contentEditable', true);
    // aux.innerHTML = content;
    // aux.setAttribute('onfocus', "document.execCommand('selectAll',false,null)"); 
    // document.body.appendChild(aux);
    // aux.focus();
    // if (document.execCommand('copy')) {
        // toastr.success(successMsg);
    // } else {
        // toastr.error(errorMsg);
    // }
    // document.body.removeChild(aux);
// }

jQuery(document).ready(function ($) {
    
    var ajaxDataSent = new $.Deferred();
    
    $.fn.isInViewport = function(offset = 0) {
        var elementTop = $(this).offset().top,
            elementBottom = elementTop + $(this).outerHeight(),
            viewportTop = $(window).scrollTop() - offset,
            viewportBottom = viewportTop + $(window).height();

        return elementBottom > viewportTop && elementTop < viewportBottom;
    };
    
    // copy to clipboard
    $('.copy').click(function () {
        var $el = $(this),
            txt = $(this).data('text'),
            successMessage = $(this).data('success') ? $(this).data('success') : 'Скопировано',
            errorMessage = $(this).data('error') ? $(this).data('error') : 'Ошибка',
            $temp = $('<input>');
            
        $el.after($temp);
        $temp.val(txt).select();
        
        if (document.execCommand('copy')) {
            toastr.success(successMessage);
        } else {
            toastr.error(errorMessage);
        }
        
        $temp.remove();
    });
    
    
    // индикатор загрузки
    // NProgress.start();
    loading = function (show = true) {
        if (show) {
            $('#loader').show();
        } else {
            $('#loader').hide();
        }
    }
    $(document).on('pjax:start', function () {
        loading();
    });
    $(document).on('pjax:end', function () {
        loading(false);
    });
    $('form').on('beforeSubmit', function () {
        loading(false);
    });
    $(window).on('beforeunload', function () {
        loading();
        $('#fade').fadeIn('fast');
        $('.modal').modal('hide');
    });
    // $(window).on('load', function () {
        // loading(false);
    // });
    $(document).on('click', '#loader', function () {
        loading(false);
    });
    
    loading(false);
    
    
    // lazy loading
    lazyload();
    $(document).on('pjax:end', function () {
        lazyload();
    });
        

    // маски
    $.mask.definitions['_'] = "[0-9]";
    setPhoneMask = function (countryCode = '+7', phoneMask = '(___) ___-__-__') {
        $('.phone-mask').mask((countryCode + ' ' + phoneMask), {
            autoclear: false
        });
    }
    setPhoneMask();
    
    
    // клики по хэш-ссылкам
    if (location.href.includes('#')) {
        $('a[href="#' + location.href.split('#')[1] + '"]').trigger('click');
    }


    // уведомления
    toastr.options = {
        tapToDismiss: true,
        positionClass: 'toast-bottom-right',
        newestOnTop: false,
        preventDuplicates: true,
        escapeHtml: false,
        iconClass: 'd-none',
        timeOut: 3000,
    };


    // модальные окна
    $(document).on('click', '[data-toggle="lightbox"], .lightbox', function (e) {
        e.preventDefault();
        $(this).ekkoLightbox({
            alwaysShowClose: true,
            loadingMessage: false,
            disableExternalCheck: false,
            onShow: function () {
                this._$modalDialog.prepend('<div class="modal-loader position-absolute top-0 left-0 right-0 bottom-0 d-flex align-items-center justify-content-center bg-white" style="z-index: 3"><div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"><span class="sr-only">Загрузка...</span></div></div>');
            },
            onShown: function () {
                setTimeout(function () {
                    $('.modal-loader').remove();
                }, 500);
            }
        });
    });


    // popover
    $('[data-toggle="popover"]').popover({
        html: true,
        trigger: 'focus',
        container: 'body',
        content: function () {
            if ($(this).is('[data-element]')) {
                return $($(this).attr('data-element')).html();
            } else {
                return $(this).attr('data-content');
            }
        },
    });
    // }).on('shown.bs.popover', function () {
        // generateOwlCarousel();
    // });

    
    // переключатель способов доставки
    $('input[name="shipping_type_switcher"]').click(function () {
        $(this).tab('show');
        $(this).removeClass('active');
        $('#order-shipping_type_id').val($(this).val()).trigger('change');
    });



    // формы

    $(document)
        .on('beforeValidate', 'form.disabling', function () {
            $(this).attr('disabled', 'disabled');
        })
        .on('afterValidate', 'form.disabling', function () {
            $(this).removeAttr('disabled');
        })
        .on('beforeSubmit', 'form.disabling', function () {
            $(this).attr('disabled', 'disabled');
        });
        
    $(document).on('submit', 'form.disabled', function (e) {
        e.preventDefault();
        return false;
    });

    $(document).on('submit', 'form.ajax', function (e) {
        e.preventDefault();
        var $form = $(this),
            url = $form.attr('action'),
            type = $form.attr('method'),
            data = $form.serialize();
        sendAjaxData($form, url, data, type, true);
    });

    // ajax-кнопки
    $(document).on('click', 'a.ajax, button.ajax', function (e) {
        e.preventDefault();
        var $link = $(this),
            url = $link.attr('data-target') ? $link.attr('data-target') : $link.attr('data-remote') ? $link.attr('data-remote') : $link.attr('href');
            if (url[0] === '/') url = location.protocol + '//' + location.hostname + url;
        sendAjaxData($link, url);
    });

    sendAjaxData = function ($element, action, params = [], method = 'get', isForm = false) {
        loading();
        $.ajax({
            url: action,
            type: method,
            data: params,
            success: function (data) {
                switch (data.status) {
                    case 'warning': toastr.warning(data.message); break;
                    case 'danger': toastr.error(data.message); break;
                    case 'error': toastr.error(data.message); break;
                    case 'success': toastr.success(data.message); break;
                    case 'info': toastr.info(data.message); break;
                }
                if (data.script && data.script != '') {
                    $('body').append('<script type="text/javascript" class="serverscript">' + data.script + ' $(".serverscript").remove();</script>');
                }
                if (data.status == 'success') {
                    $element.find('input[type="text"]').val('');
                    $('.modal').modal('hide');
                }
                if (data.error && data.error != '') {
                    console.log(data.error);
                }
            },
            error: function (data) {
                toastr.error('Ошибка! Попробуйте еще раз чуть позже');
                console.log(data);
                return false;
            },
            complete: function () {
                loading(false);
                ajaxDataSent.resolve();
            }
        });
    }


    // OWL

    owlCarouselInit = function (item) {
        var itemCount = ($(item).attr('data-items')) ? $(item).attr('data-items').split('-') : [1,1,1,1,1,1],
            owlAutoPlay = ($(item).attr('data-autoplay') == 'true' || $(item).hasClass('owl-autoplay')) ? true : false,
            owlAutoPlayTimeout = ($(item).attr('data-speed')) ? parseFloat($(item).attr('data-speed')) : 5000,
            owlAutoplayHoverPause = ($(item).attr('data-hoverstop') == 'true' || $(item).hasClass('owl-hoverstop')) ? true : false,
            owlAutoHeight = ($(item).attr('data-autoheight') == 'true' || $(item).hasClass('owl-autoheight')) ? true : false,
            owlAutoWidth = ($(item).attr('data-autowidth') == 'true' || $(item).hasClass('owl-autowidth')) ? true : false,
            owlNav = ($(item).attr('data-nav') == 'true' || $(item).hasClass('owl-nav')) ? true : false,
            owlDots = ($(item).attr('data-dots') == 'true' || $(item).hasClass('owl-dots')) ? true : false,
            owlLazyLoad = ($(item).attr('data-lazy') == 'true' || $(item).hasClass('owl-lazyload')) ? true : false,
            owlAnimateIn = ($(item).attr('data-animatein')) ? $(item).attr('data-animatein') : false,
            owlAnimateOut = ($(item).attr('data-animateout')) ? $(item).attr('data-animateout') : false,
            owlCenter = ($(item).attr('data-center') == 'true' || $(item).hasClass('owl-center')) ? true : false,
            owlLoop = ($(item).attr('data-loop') == 'true' || $(item).hasClass('owl-loop')) ? true : false,
            owlMargin = ($(item).attr('data-margin')) ? parseFloat($(item).attr('data-margin')) : false,
            owlRandom = ($(item).attr('data-random') == 'true' || $(item).hasClass('owl-random')) ? true : false;
            if ($(item).hasClass('owl-fade')) {
                owlAnimateIn = 'fadeIn';
                owlAnimateOut = 'fadeOut';
            }
            if ($(item).hasClass('owl-autoplay')) {
                owlAutoPlayTimeout = 3000;
            }
        $(item).owlCarousel({
            items: parseFloat(itemCount[0]),
            responsive:{
                0:{
                    items: parseFloat(itemCount[0])
                },
                480:{
                    items: parseFloat(itemCount[1])
                },
                768:{
                    items: parseFloat(itemCount[2])
                },
                992:{
                    items: parseFloat(itemCount[3])
                },
                1200:{
                    items: parseFloat(itemCount[4])
                },
                1440:{
                    items: parseFloat(itemCount[5])
                }
            },
            responsiveBaseElement: 'body',
            autoplay: owlAutoPlay,
            autoplayTimeout: owlAutoPlayTimeout,
            autoplayHoverPause: owlAutoplayHoverPause,
            autoHeight: owlAutoHeight,
            autoWidth: owlAutoWidth,
            nav: owlNav,
            dots: owlDots,
            lazyLoad: owlLazyLoad,
            animateIn: owlAnimateIn,
            animateOut: owlAnimateOut,
            center: owlCenter,
            loop: owlLoop,
            margin: owlMargin,
            checkVisibility: false,
            navText: [
                '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>', 
                '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/></svg>'
            ],
            onInitialize: function (element) {
                if (owlRandom === true) {
                    $(item).children().sort(function () {
                        return Math.round(Math.random()) - 0.5;
                    }).each(function () {
                        $(this).appendTo($(item));
                    });
                }
                // imageZoom();
            },
            onDragged: function () {
                // imageZoom();
            },
            onChanged: function (event) {
                $(item).attr('data-item', event.item.index ? event.item.index-1 : event.item.index);
                // imageZoom();
            },
        });
    }

    generateOwlCarousel = function () {
        $('.owl-carousel').each(function () {
            owlCarouselInit($(this));
        });
    }

    generateOwlCarousel();
    
    owlGoTo = function (id, slide, speed = 300) {
        $(id).trigger('to.owl.carousel', [slide, speed]);
    }
    

    // SLICK
    
    $('.reviews-carousel').slick({
        arrows: false,
        centerMode: true,
        infinite: true,
        variableWidth: true,
        adaptiveHeight: true,
        draggable: false,
        lazyLoad: 'progressive',
        centerPadding: '60px',
        speed: 0,
        waitForAnimate: false,
        slidesToShow: 5,
        responsive: [
            {
                breakpoint: 576,
                settings: {
                    draggable: true,
                    slidesToShow: 1,
                    centerPadding: '60px',
                }
            },
            {
                breakpoint: 768,
                settings: {
                    draggable: true,
                    slidesToShow: 3,
                    centerPadding: '60px',
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    draggable: false,
                    slidesToShow: 5,
                    centerPadding: '60px',
                }
            }
        ]
    });
    $(document).on('click', '.slick-slide:not(.slick-current)', function () {
        var goTo = $(this).attr('data-slick-index');
        $('.reviews-carousel').slick('slickGoTo', goTo);
    })


    // выпадающее меню
    $(document).on('click.bs.dropdown.data-api', '.dropdown-menu', function (event) {
        event.stopPropagation();
    });
    
    
    // MAIN MENU
    
    $('#menu')
        .on('show.bs.modal', function (event) {
            if (event.target.id) {
                $('#nav')
                    .removeClass('navbar-light bg-white')
                    .addClass('navbar-dark bg-gray-900');
            }
        })
        .on('hide.bs.modal', function (event) {
            if (event.target.id == 'menu') {
                $('#nav')
                    .removeClass('navbar-dark bg-gray-900')
                    .addClass('navbar-light bg-white');
            }
        });
        
        

    // ПРЕИМУЩЕСТВА на Главной
    
    if ($('body').data('page') == btoa('site/index')) {
        $(window).on('load', function () {
            $('#index3 .advantages').css('top', $('#index3 .title').outerHeight());
            $('#index3 .title').data('height', $('#index3 .title').height());
            $('#index3 .advantages').each(function () {
                $(this).data('height', $(this).height());
            });
            // var lastAdvHeight = $('.advantages:last-child').height();
            // $('.advantages:last-child').css('height', 0);
            // $('#index3').css('paddingBottom', lastAdvHeight);
        });
        
        $(window).on('scroll', function (event) {
            $('#index3 .description').toggleClass('fade', $(window).scrollTop() > $('#index3 .description').offset().top - $('#index3 .title').outerHeight());
            
            $('#index3 .advantages').each(function (k, item) {
                var offset = $(this).offset().top - $(window).scrollTop() - $('#index3 .title').outerHeight(),
                    percent = offset / ($(this).height() * 1.2);

                $(this).toggleClass('is-visible', $(window).scrollTop() > (Math.round($(this).offset().top) - $(window).height()/2));
                
                if ($(this).hasClass('is-visible')) {
                    $(this).prev('.advantages').css('opacity', percent > 1 ? 1 : percent);
                    $(this).next('.advantages').css('opacity', percent > 1 && percent < 2 ? 0 : 1 - percent);
                }
                
                if ($(this).is(':last-child')) {
                    $('#index3 .title').css('top', offset > 0 ? 0 : offset);
                }
            });
        });
    }
    
    
    
    // FANCYBOX
    Fancybox.bind('.fancybox', {
        Image: {
            fit: 'cover',
            Panzoom: {
                baseScale: 1,
                maxScale: 1,
            },
        },
    });


    // выбор размера
    $(document).on('click', '.dropdown-change-select', function () {
        var $element = $(this).parents('.dropdown').find('button[data-toggle="dropdown"]'),
            id = $(this).data('id'),
            val = $(this).data('value'),
            txt = $(this).text();
            
        $('select[data-id="' + id + '"]')
            .val(val)
            .trigger('change');
            
        $element
            .text(txt)
            .attr('aria-expanded', false)
            .addClass('changed');
            
        $element.dropdown('hide');
    });

    // показ нотификации выбора размера
    $('.dvizh-cart-buy-button, .product-buy, #product-wishlist').click(function (event) {
        event.preventDefault();
        if ($(this).is(':disabled') || $(this).children().is(':disabled')) {
            $('.select-size-note').show();
            return false;
        }
    });
    

    // wishlist
    wishlistCheck = function () {
        var $btn = $('.btn-wishlist');
        $.get('/' + $btn.data('lang') + '/wishlist/check', {
            'product_id': $btn.data('product'),
            'size': $btn.data('size')
        }, function(data) {
            $btn.replaceWith(data);
        });
    }
    $(document).on('click', '.btn-wishlist', function () {
        $.get('/' + $(this).data('lang') + '/wishlist/' + $(this).data('action'), {
            'product_id': $(this).data('product'),
            'size': $(this).data('size')
        }, function () {
            wishlistCheck();
        });
    });
    
    
    // bonus gift
    $(document).on('click', '.bonus-gift', function () {
        var $btn = $(this),
            url = $(this).data('url'),
            params = {
                user: $(this).data('user'),
                sum: parseFloat($('input[name="bonus-gift-' + $(this).data('user') + '"]:checked').val())
            };
        
        ajaxDataSent = new $.Deferred();

        $.when(ajaxDataSent).then(function () {
            $.pjax.reload({
                container: '#pjax-bonuses',
                async: false
            });
            $.pjax.reload({
                container: '#pjax-friends',
                async: false
            });
        });
        
        sendAjaxData($btn, url, params);    
    });
    
    
    // cookies
    // setTimeout(function () {
        // $('#cookiesNotification').addClass('show');
        // if ($('#cookiesNotification').data('type') == '3'){
            // var translate = $('#cookiesNotification').height();
            // $('#nav').css({
                // '-webkit-transform': 'translateY(' + translate + 'px)',
                // '-ms-transform': 'translateY(' + translate + 'px)',
                // 'transform': 'translateY(' + translate + 'px)'
            // })
        // }
    // }, 1000);
    
    
    // товар в подарок
    // giftProduct = function () {
        // if ($('body').is('[data-gift]')) {
            // var data = JSON.parse(atob($('body').data('gift'))),
                // giftAlreadyInCart = $('.cart-product').is('[data-id="' + data.id + '"]'),
                // otherProductsInCart = $('.cart-product').not('[data-id="' + data.id + '"]').length,
                // cartQty = parseFloat($('.dvizh-cart-count').text());

            // if (cartQty > 0 && !giftAlreadyInCart) {
                // dvizh.cart.addElement(data.model, data.item_id, data.count, data.price, data.options, data.url, data.id);
            // }
            
            // if (giftAlreadyInCart && !otherProductsInCart) {
                // $('.cart-product[data-id="' + data.id + '"]')
                    // .find('.dvizh-cart-delete-button')
                    // .click();
            // }
            
            // if (giftAlreadyInCart && $('.cart-product[data-id="' + data.id + '"]').find('.dvizh-cart-element-count').val() > 1) {
                // $('.cart-product[data-id="' + data.id + '"]').find('.cart-change-count.minus').click();
            // }
        // }
    // }
    // giftProduct();
    // $(document).on('renderCart', giftProduct);


    // Яндекс Ecommerce
    // ymDetail = function (id, name, price, variant, currency) {
        // window.dataLayer.push({
            // 'ecommerce': {
                // 'currencyCode': currency,
                // 'detail': {
                    // 'products': [
                        // {
                            // 'id': id,
                            // 'name': name,
                            // 'price': price,
                            // 'variant': variant,
                        // }
                    // ]
                // }
            // }
        // });
        // ym(85187701, 'reachGoal', 'ViewContent');
    // }

    // ymAdd = function (id, name, price, variant, currency) {
        // window.dataLayer.push({
            // 'ecommerce': {
                // 'currencyCode': currency,
                // 'add': {
                    // 'products': [
                        // {
                            // 'id': id,
                            // 'name': name,
                            // 'quantity': 1,
                            // 'price': price,
                            // 'variant': variant,
                        // }
                    // ]
                // }
            // }
        // });
        // ym(85187701, 'reachGoal', 'AddToCard');
    // }

    // ymRemove = function (id, name, price, variant, currency) {
        // window.dataLayer.push({
            // 'ecommerce': {
                // 'currencyCode': currency,
                // 'remove': {
                    // 'products': [
                        // {
                            // 'id': id,
                            // 'name': name,
                            // 'quantity': 1,
                            // 'price': price,
                            // 'variant': variant,
                        // }
                    // ]
                // }
            // }
        // });
        // ym(85187701, 'reachGoal', 'RemoveToCard');
    // }

    // ymPurchase = function (id, products, currency) {
        // window.dataLayer.push({
            // 'ecommerce': {
                // 'currencyCode': currency,
                // 'purchase': {
                    // 'actionField': {
                        // 'id': id,
                    // },
                    // 'products': JSON.parse(products)
                // }
            // }
        // });
        // ym(85187701, 'reachGoal', 'Purchase');
    // }


    // Facebook pixel
    // fbqViewContent = function (id, name, price, variant, currency) {
        // fbq('track', 'ViewContent',
            // {
                // value: price,
                // currency: currency,
                // contents: [
                    // {
                        // id: id,
                        // quantity: 1,
                        // name: name,
                        // price: price,
                        // variant: variant,
                    // },
                // ],
                // content_type: 'product',
            // }
        // );
        
        // $.get('/facebook-conversions', {
            // data: JSON.stringify({
                // event_name: 'ViewContent',
                // currency: currency,
                // value: price,
                // contents: [
                    // {
                        // id: id,
                        // quantity: 1,
                        // price: price,
                    // },
                // ],
                // content_type: 'product',
                // name: name,
                // variant: variant
            // })
        // });
    // }

    // fbqAddToCart = function (id, name, price, variant, currency) {
        // fbq('track', 'AddToCart',
            // {
                // value: price,
                // currency: currency,
                // contents: [
                    // {
                        // id: id,
                        // quantity: 1,
                        // name: name,
                        // price: price,
                        // variant: variant,
                    // },
                // ],
                // content_type: 'product',
            // }
        // );
        
        // $.get('/facebook-conversions', {
            // data: JSON.stringify({
                // event_name: 'AddToCart',
                // currency: currency,
                // value: price,
                // contents: [
                    // {
                        // id: id,
                        // quantity: 1,
                        // price: price,
                    // },
                // ],
                // content_type: 'product',
                // name: name,
                // variant: variant
            // })
        // });
    // }

    // fbqPurchase = function (products, sum, currency) {
        // fbq('track', 'Purchase',
            // {
                // value: sum,
                // currency: currency,
                // contents: JSON.parse(products),
                // content_type: 'product',
            // }
        // );
        
        // $.get('/facebook-conversions', {
            // data: JSON.stringify({
                // event_name: 'Purchase',
                // currency: currency,
                // value: sum,
                // contents: JSON.parse(products),
                // content_type: 'product',
                // name: '',
                // variant: ''
            // })
        // });
    // }
    
    
    // $(document).on('click', '.cart-change-count', function () {
        // var plus = $(this).hasClass('plus'),
            // $row = $(this).parents('.cart-product'),
            // id = $row.attr('data-id'),
            // name = $row.attr('data-name'),
            // price = $row.attr('data-price'),
            // variant = $row.find('.cart-product-variant').text(),
            // currency = $row.attr('data-currency');
            
        // if (plus) {
            // ymAdd(id, name, price, variant, currency);
            // fbqAddToCart(id, name, price, variant, currency);
        // } else {
            // ymRemove(id, name, price, variant, currency);
        // }
    // });


    
});