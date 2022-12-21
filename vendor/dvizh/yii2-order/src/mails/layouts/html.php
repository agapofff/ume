<?php
	use yii\helpers\Url;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; margin: 0; padding: 0;">
	<head>
		<meta name="viewport" content="width=device-width" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<?php $this->head() ?>
		<style>
			* {
				font-family: Helvetica, Arial, sans-serif;
			}
			*, body, h1, h2, h3, h4, a, p, div, table, tr, td {
				color: #000 !important;
			}
			p, td, div {
				font-size: 16px;
			}
			h1 {
				font-size: 30px;
			}
		</style>
	</head>
	<body bgcolor="#fff">
		<div bgcolor="#fff" style="
			position: relative;
			font-family: Helvetica, Arial, sans-serif; 
			font-size: 100%; 
			line-height: 1.6; 
			-webkit-font-smoothing: antialiased; 
			-webkit-text-size-adjust: none; 
			width: 100% !important; 
			height: 100%; 
			margin: 0; 
			padding: 0; 
			background-color: #fff;
		">
			<table class="body-wrap" style="
				font-family: Helvetica, Arial, sans-serif; 
				font-size: 100%; 
				line-height: 1.6; 
				width: 100%; 
				margin: 0; 
				padding: 20px;
			">
				<tr style="
					font-family: Helvetica, Arial, sans-serif; 
					font-size: 100%; 
					line-height: 1.6; 
					margin: 0; 
					padding: 0;
				">
					<td style="
						font-family: Helvetica, Arial, sans-serif; 
						font-size: 100%; 
						line-height: 1.6; 
						margin: 30px 0; 
						padding: 0; 
						text-align: center;
					">
						<img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTY0IiBoZWlnaHQ9IjYwIiB2aWV3Qm94PSIwIDAgMTY0IDYwIiBmaWxsPSJub25lIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPgo8ZyBjbGlwLXBhdGg9InVybCgjY2xpcDBfMl83KSI+CjxwYXRoIGQ9Ik02LjUzMDA4IDUzLjAwNThDMi4xNzY2OSA0OC4zNDM2IDAgNDEuNjg2MSAwIDMzLjAzMzJWLTUuODU3NjVlLTA1SDEyLjY3MTRWMzIuNTI3OEMxMi42NzE0IDQzLjA5MDMgMTYuNzM4MyA0OC4zNzE2IDI0Ljg3MjIgNDguMzcxNkMyOC44MzUxIDQ4LjM3MTYgMzEuODYwMSA0Ny4wOTM1IDMzLjk0NzEgNDQuNTM3NEMzNi4wMzQyIDQxLjk4MTMgMzcuMDc2NiAzNy45NzggMzcuMDc0MyAzMi41Mjc0Vi0wLjAwMDQ4ODI4MUg0OS41OVYzMy4wMzMyQzQ5LjU5IDQxLjY4NDQgNDcuNDEyOSA0OC4zNDE5IDQzLjA1ODYgNTMuMDA1OEMzOC43MDQ0IDU3LjY2OTcgMzIuNjE2MyA2MC4wMDExIDI0Ljc5NDQgNjBDMTYuOTcyNCA2MCAxMC44ODQzIDU3LjY2ODYgNi41MzAwOCA1My4wMDU4WiIgZmlsbD0iIzQ2NTA3NyIvPgo8cGF0aCBkPSJNMTAzLjA0MSA1OC45ODg1TDEwMy4wNSAyMy41OTU4TDg2LjkzNyA1Mi43NTI4SDgxLjIyNjdMNjUuMTkyOSAyNC4zNTQyVjU4Ljk4NzZINTMuMzAzOFYwSDYzLjc4MzlMODQuMjc3NyAzNi42NTczTDEwNC40NTcgMEgxMTQuODZMMTE0LjkzIDU4Ljk4ODVIMTAzLjA0MVoiIGZpbGw9IiM0NjUwNzciLz4KPHBhdGggZD0iTTE2MS4xMjYgNDguMDMzNFY1OC45ODg1SDExOC43MzFWMEgxNjAuMTA2VjEwLjk1NzJIMTMxLjMyM1YyMy43NjM4SDE1Ni43NDJWMzQuMzg0NkgxMzEuMzIzVjQ4LjAzNTZMMTYxLjEyNiA0OC4wMzM0WiIgZmlsbD0iIzQ2NTA3NyIvPgo8cGF0aCBkPSJNMTYzLjA1NyAyLjI3NTQ1TDE2Mi42ODkgMS43NTk4MkMxNjIuNjQ2IDEuNzY0NTggMTYyLjYwMyAxLjc2Njg3IDE2Mi41NiAxLjc2NjdIMTYyLjEzVjIuMjc1NDVIMTYxLjk1OFYwLjY2Nzk2OUgxNjIuNTZDMTYyLjc2NiAwLjY2Nzk2OSAxNjIuOTI3IDAuNzE2OTU0IDE2My4wNDMgMC44MTQ5MjRDMTYzLjEwMSAwLjg2NDU0MSAxNjMuMTQ3IDAuOTI2Nzc2IDE2My4xNzcgMC45OTY4NjJDMTYzLjIwNyAxLjA2Njk1IDE2My4yMjEgMS4xNDMwMiAxNjMuMjE3IDEuMjE5MjdDMTYzLjIyMSAxLjMzMjYzIDE2My4xODggMS40NDQxNCAxNjMuMTIyIDEuNTM2ODFDMTYzLjA1NCAxLjYyNjkgMTYyLjk1OCAxLjY5MjU5IDE2Mi44NSAxLjcyNDE2TDE2My4yNDMgMi4yNzU0NUgxNjMuMDU3Wk0xNjIuOTIxIDEuNTE1MzJDMTYyLjk2NCAxLjQ3ODkzIDE2Mi45OTcgMS40MzMzMSAxNjMuMDE5IDEuMzgxOThDMTYzLjA0MSAxLjMzMDY2IDE2My4wNTEgMS4yNzQ5OSAxNjMuMDQ4IDEuMjE5MjdDMTYzLjA1MSAxLjE2Mjc4IDE2My4wNDIgMS4xMDYyNCAxNjMuMDIgMS4wNTQwNkMxNjIuOTk4IDEuMDAxODggMTYyLjk2NCAwLjk1NTQ3OSAxNjIuOTIxIDAuOTE4NDhDMTYyLjgzNyAwLjg0ODg3IDE2Mi43MTUgMC44MTQwNjUgMTYyLjU1NiAwLjgxNDA2NUgxNjIuMTI5VjEuNjIxMDNIMTYyLjU1NkMxNjIuNzE1IDEuNjIxMDMgMTYyLjgzNyAxLjU4NTc5IDE2Mi45MjEgMS41MTUzMloiIGZpbGw9IiM0NjUwNzciLz4KPHBhdGggZD0iTTE2Mi41MjcgMi45NDM0MUMxNjIuMjM2IDIuOTQzNDEgMTYxLjk1MSAyLjg1NzE0IDE2MS43MDkgMi42OTU1QzE2MS40NjcgMi41MzM4NyAxNjEuMjc4IDIuMzA0MTIgMTYxLjE2NiAyLjAzNTNDMTYxLjA1NSAxLjc2NjQ4IDE2MS4wMjUgMS40NzA2NiAxNjEuMDgyIDEuMTg1MjJDMTYxLjEzOSAwLjg5OTc4NiAxNjEuMjc5IDAuNjM3NTUxIDE2MS40ODUgMC40MzE2NjFDMTYxLjY5MSAwLjIyNTc3MSAxNjEuOTUzIDAuMDg1NDY5IDE2Mi4yMzkgMC4wMjg0ODg5QzE2Mi41MjQgLTAuMDI4NDkxMSAxNjIuODIgMC4wMDA0MDg0NDcgMTYzLjA5IDAuMTExNTM1QzE2My4zNTkgMC4yMjI2NjEgMTYzLjU4OSAwLjQxMTAyNiAxNjMuNzUxIDAuNjUyODJDMTYzLjkxMyAwLjg5NDYxNSAxNjQgMS4xNzg5OCAxNjQgMS40Njk5OUMxNjQgMS44NjA1IDE2My44NDUgMi4yMzUwOCAxNjMuNTY5IDIuNTExMzdDMTYzLjI5MyAyLjc4NzY3IDE2Mi45MTggMi45NDMwNyAxNjIuNTI3IDIuOTQzNDFaTTE2Mi41MjcgMC4xMzQ5MjVDMTYyLjI2MiAwLjEzNDkyNSAxNjIuMDAzIDAuMjEzMzY5IDE2MS43ODMgMC4zNjAzMzNDMTYxLjU2MyAwLjUwNzI5NyAxNjEuMzkyIDAuNzE2MTc1IDE2MS4yOTEgMC45NjA1NEMxNjEuMTg5IDEuMjA0OSAxNjEuMTYzIDEuNDczNzcgMTYxLjIxNSAxLjczMzEzQzE2MS4yNjcgMS45OTI0OSAxNjEuMzk0IDIuMjMwNjggMTYxLjU4MSAyLjQxNzU2QzE2MS43NjkgMi42MDQ0NCAxNjIuMDA3IDIuNzMxNjIgMTYyLjI2NyAyLjc4MzAxQzE2Mi41MjcgMi44MzQ0IDE2Mi43OTYgMi44MDc2OCAxNjMuMDQgMi43MDYyNEMxNjMuMjg1IDIuNjA0NzkgMTYzLjQ5NCAyLjQzMzE5IDE2My42NCAyLjIxMzEzQzE2My43ODcgMS45OTMwNyAxNjMuODY1IDEuNzM0NDUgMTYzLjg2NSAxLjQ2OTk5QzE2My44NjQgMS4xMTU4NSAxNjMuNzIzIDAuNzc2NDc3IDE2My40NzIgMC41MjYyMjdDMTYzLjIyMSAwLjI3NTk3OCAxNjIuODgxIDAuMTM1MjY1IDE2Mi41MjcgMC4xMzQ5MjVWMC4xMzQ5MjVaIiBmaWxsPSIjNDY1MDc3Ii8+CjwvZz4KPGRlZnM+CjxjbGlwUGF0aCBpZD0iY2xpcDBfMl83Ij4KPHJlY3Qgd2lkdGg9IjE2NCIgaGVpZ2h0PSI2MCIgZmlsbD0id2hpdGUiLz4KPC9jbGlwUGF0aD4KPC9kZWZzPgo8L3N2Zz4K" style="
							display: block; 
							max-width: 100%; 
							margin: 0 auto;
						">
                        <br>
					</td>
				</tr>
				<tr style="
					font-family: Helvetica, Arial, sans-serif; 
					font-size: 100%; 
					line-height: 1.6; 
					margin: 0; 
					padding: 0;
				">
					<td class="container" style="
						font-family: Helvetica, Arial, sans-serif; 
						font-size: 100%; 
						line-height: 1.6; 
						display: block !important; 
						max-width: 600px !important; 
						clear: both !important; 
						margin: 0 auto; 
						padding: 0; 
						color: #000; 
					">
						<div class="content" style="
							font-family: Helvetica, Arial, sans-serif; 
							font-size: 100%; 
							line-height: 1.6; 
							max-width: 600px; 
							display: block; 
							margin: 0 auto; 
							padding: 20px;
						">
							<table style="
								font-family: Helvetica, Arial, sans-serif; 
								font-size: 100%; 
								line-height: 1.6; 
								width: 100%; 
								margin: 0; 
								padding: 0;
							">
								<tr style="
									font-family: Helvetica, Arial, sans-serif;
									font-size: 100%; 
									line-height: 1.6; 
									margin: 0; 
									padding: 0;
								">
									<td style="
										font-family: Helvetica, Arial, sans-serif; 
										font-size: 100%; 
										line-height: 1.6; 
										margin: 0; 
										padding: 0; 
										color: #000; 
									">
										<?php $this->beginBody() ?>
										<?= $content ?>
										<?php $this->endBody() ?>
									</td>
								</tr>
							</table>
						</div>
					</td>
					<td style="
						font-family: Helvetica, Arial, sans-serif; 
						font-size: 100%; 
						line-height: 1.6; 
						margin: 0; 
						padding: 0;
					"></td>
				</tr>
			</table>
			
			<table class="footer-wrap" style="
				font-family: Helvetica, Arial, sans-serif; 
				font-size: 100%; 
				line-height: 1.6; 
				width: 100%; 
				clear: both !important; 
				margin: 0; 
				padding: 0;
			">
				<tr style="
					font-family: Helvetica, Arial, sans-serif; 
					font-size: 100%; 
					line-height: 1.6; 
					margin: 0; 
					padding: 0;
				">
					<td style="
						font-family: Helvetica, Arial, sans-serif; 
						font-size: 100%; 
						line-height: 1.6; 
						margin: 0; 
						padding: 0;
					"></td>
					<td class="container" style="
						font-family: Helvetica, Arial, sans-serif; 
						font-size: 100%; 
						line-height: 1.6; 
						display: block !important; 
						max-width: 600px !important; 
						clear: both !important; 
						margin: 0 auto; 
						padding: 0;
					">
						<div class="content" style="
							font-family: Helvetica, Arial, sans-serif; 
							font-size: 100%; 
							line-height: 1.6; 
							max-width: 600px; 
							display: block; 
							margin: 0 auto; 
							padding: 20px;
						">
							<table style="
								font-family: Helvetica, Arial, sans-serif; 
								font-size: 100%; 
								line-height: 1.6; 
								width: 100%; 
								margin: 0; 
								padding: 0;
							">
								<tr style="
									font-family: Helvetica, Arial, sans-serif; 
									font-size: 100%; 
									line-height: 1.6; 
									margin: 0; 
									padding: 0;
								">
									<td align="center" style="
										font-family: Helvetica, Arial, sans-serif; 
										font-size: 100%; 
										line-height: 1.6; 
										margin: 0; 
										padding: 0;
									">
										<p style="
											font-family: Helvetica, Arial, sans-serif; 
											font-size: 12px; 
											line-height: 1.6; 
											color: #000; 
											font-weight: normal; 
											margin: 0 0 10px; 
											padding: 0;
										">
											© <?= date('Y') ?> <?= Yii::$app->name ?>
										</p>
									</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>
<?php $this->endPage() ?>
