

// анимация загрузки
function showLoader(){
    // $('#loader').show();
    // setTimeout(function(){
        // hideLoader();
    // }, 3000);
}
function hideLoader(){
    $('#loader').hide();
}
$(document).ready(function(){
    hideLoader();
});
$(document).on('click', '#loader', function(){
    hideLoader();
});
window.addEventListener('beforeunload', function(e){
    showLoader();
}, false);
$(document).on('pjax:send', function(){
	showLoader();
});
$(document).on('pjax:end', function(){
	hideLoader();
	tableSortInit();
});



// вставка видео

function getEmbedVideo(id){
    return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' + id + '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
}

function setEmbedVideo(id){
    if ($('#' + id).val() && $('#' + id).val().includes('youtu')){
        var videoId = $('#' + id).val().split('?')[0].split('/').pop(),
            embedVideo = getEmbedVideo(videoId);
        $('#' + id + '-embed').html(embedVideo);    
    } else {
        $('#' + id + '-embed').empty();
    }
}

$(document).ready(function(){
    $('.video-input').each(function(){
        setEmbedVideo($(this).attr('id'));
    })
});

$(document).on('change', '.video-input', function(){
    var id = $(this).attr('id');
    setEmbedVideo(id);
});

$(document).on('click', '.video-remove', function(){
    $('#product-videoFile').val('');
    $('#product-video-embed').remove();
    $('#product-video-form').show();
});



// вставка изображений при изменении инпута

function setEmbedImage(input){
    if (input.files && input.files[0]){
        var reader = new FileReader();
        reader.onload = function(e){
            $('#' + $(input).attr('id') + '-embed').html('<img src="' + e.target.result + '" class="img-responsive">');
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        $('#' + $(input).attr('id') + '-embed').empty();
    }
}

$(document).on('change', '.image-input', function(){
    setEmbedImage(this);
});



// модальные окна по ссылке
/*
$(document).delegate('*[data-toggle="lightbox"], .lightbox', 'click', function(a){
    a.preventDefault();
    $(this).ekkoLightbox();
});
*/



// сохранить и закрыть
$(document).on('click', 'button.saveAndExit', function(){
    $('input.saveAndExit').val(1).parents('form').submit();
});



// pjax-ссылки

$(document).on('click', '.pjax', function(e){
    e.preventDefault();
    var url = $(this).attr('href'),
        pjaxId = $(this).parents('[data-pjax-container]').attr('id');
    $.get(url, function(){
        $.pjax.reload({
            container: '#' + pjaxId,
            async: false
        });
    });
});


// JSON-поля в форме товара
$('form').on('beforeValidate', function(event){
    event.preventDefault();
    
    $('.is_sub_json').each(function(){
        var $field = $(this),
            id = $(this).attr('id'),
            fields = {};
        $('.sub_json_field[data-field="' + id + '"]').each(function(){
            var key = $(this).attr('data-key'),
                text = $(this).val();
            fields[key] = text;
        });
        $field.val(JSON.stringify(fields));
    });
    
    $('.is_json').each(function(){
        var $field = $(this),
            id = $(this).attr('id'),
            fields = {},
            required = $(this).parent().hasClass('required'),
            isCorrect = true;
        $('.json_field[data-field="' + id + '"]').each(function(){
            var lang = $(this).attr('data-lang'),
                text = $(this).val();
            if (!text && required){
                isCorrect = false;
            }
            fields[lang] = text;
        });
        $field.val(isCorrect ? JSON.stringify(fields) : '');
    });
    // return false;
});



// модификации

$(document).on('click', '#modification-add-btn', function(){
    var lang = $('#tab-mod > li.active > a').attr('data-lang'),
        store = $($('#tab-mod > li.active a').attr('href') + ' > .nav > li.active > a').attr('data-store'),
        store_name = $($('#tab-mod > li.active a').attr('href') + ' > .nav > li.active > a').text();
    $('#modification-add-window').contents().find('#modification-lang').val(lang);
    $('#modification-add-window').contents().find('#modification-store_type').val(store);
    $('#modification-add-window').contents().find('#filterValue3 option:contains("' + lang + '")').prop('selected', true);
    $('#modification-add-window').contents().find('#filterValue3').trigger('change');
    $('#modification-add-window').contents().find('#filterValue4 option:contains("' + store_name + '")').prop('selected', true);
    $('#modification-add-window').contents().find('#filterValue4').trigger('change');
});

$(document).on('pjax:beforeSend', '#product-modifications', function(event){
    $('#product-modifications').attr('data-lang', $('#product-modifications ul li.active a').attr('href'));
    $('#product-modifications').attr('data-type', $('#product-modifications .tab-content .tab-pane.active ul li.active a').attr('href'));
});

$(document).on('pjax:end', '#product-modifications', function(event){
    // hideLoader();
    $('a[href="' + $('#product-modifications').attr('data-lang') + '"]').click();
    $('a[href="' + $('#product-modifications').attr('data-type') + '"]').click();
});

$(document).on('hidden.bs.modal', '#modification-add-modal', function(event){
    $.pjax.reload({
        container: '#product-modifications',
        async: false
    });
});

function modificationsRefresh(){
    $('.modal').modal('hide');
    $.pjax.reload('#product-modifications');
}


$(document).ready(function(){
	tableSortInit();
});

tableSortInit = function(){
	$('.sortable tbody').sortable({
		items: 'tr',
		placeholder: 'emptySpace',
		handle: '.sort-handler',
		helper: function(e, ui) {
			ui.children().each(function() {
				$(this).width($(this).width());
			});
			return ui;
		},
		update: function(){
			$($('.sortable').hasClass('desc') ? $('.sortable tbody tr').get().reverse() : $('.sortable tbody tr').get()).each(function(key, element){
// console.log(key + ' - ' + $(this).data('url'));
					$.ajax({
						url: $(this).data('url'),
						type: 'get',
						data: {
							ordering: key
						},
						async: false,
					});
				})
				.promise()
				.done(function(){
					$.pjax.reload({
						container: '#' + $('[data-pjax-container]').attr('id'),
					});
				});
		}
	});
}