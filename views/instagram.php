				<div class="jumbotron">
					<p class="lead">With <strong>INSTATAKE.PHP</strong> you can back up all the pictures of your instagram account or download all the pictures from your most beloved instagrammers.
					Just fill the username and click "Download".</p>
				</div>

				<center>
					<div class=slider-cont>
						Select how many pics you want to download at max. </br>
						<input id="ex7" type="text" data-slider-min="1" data-slider-max="1000" data-slider-step="1" data-slider-value="<?php echo $max_number_images; ?>" data-slider-enabled="false"/>
						<input id="ex7-enabled" type="checkbox"/> Custom max value
					</div>
					<input id="network" value="instagram" type="hidden" />
					<input id="search" type="search" class="form-control" placeholder="Instagram username" required autofocus>
					</br>
					<a id="download" class="btn btn-lg btn-warning has-spinner" <?php if(empty($folder_path)) echo 'disabled="disabled"'; ?> >
						<span class="spinner"><i class="icon-spin icon-refresh"></i></span>
						Download
					</a>
				</center>
