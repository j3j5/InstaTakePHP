				<div class="jumbotron">
					<p class="lead">With <strong>INSTATAKE.PHP</strong> you can back up all the tweets of your twitter account or download all the pictures from your most beloved Twitter users.
					Just fill the username and click "Download".</p>
				</div>

				<center>
					<div id="search-container" class="input-group">
						<input id="network" value="twitter" type="hidden" />
						<span class="input-group-addon" id="basic-addon1">@</span>
						<input id="search" type="search" class="form-control" placeholder="Twitter username" required autofocus />
					</div>
					</br>
					<a id="download" class="btn btn-lg btn-warning has-spinner" <?php if(empty($folder_path)) echo 'disabled="disabled"'; ?> >
						<span class="spinner"><i class="icon-spin icon-refresh"></i></span>
						Download
					</a>
				</center>
