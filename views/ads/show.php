<!--Page for single advertisement -->
<div class="container" id="showItemContainer">
	<div class="row">
		<div <?php if (Auth::id() == $showItem->user_id): ?> id="showAuthImage"<?php endif; ?> class="col-sm-6">
			<div class="panel panel-primary">
					<div class="panel-heading" id="itemsPanelColor"><?= $showItem->title ?><div class="pull-right"><?= "$" . $showItem->price ?></div></div>
					<div class="panel-body"><img src=<?= "$showItem->image" ?> class="img-responsive" id="showItemImage" alt="Image"></div>
					<div class="panel-footer"><?= $showItem->description ?></div>
			</div>
			<?php if (Auth::id() == $showItem->user_id): ?>
				<a id="showAuthButtons" href="" class="btn btn-primary" data-toggle="modal" data-target="#editAd">Edit Ad</a>
				<a id="showAuthButtons" class="btn btn-primary pull-right" href="" data-toggle="modal" data-target="#deleteAd">Delete Ad</a>
			<?php endif; ?>
		</div>
		<div <?php if (Auth::id() == $showItem->user_id): ?> style="display: none"<?php endif; ?> id="showUserInfo" class="col-sm-6">
			<?php if (Auth::id() != $showItem->user_id): ?>
				<h3><strong>Posted By <?= $user->username ?></strong></h3>

				<h4><strong>Full Name:</strong></h4>
					<p><i style="margin-right: 0.5em" class="fa fa-user" aria-hidden="true"></i><?= $user->name ?></p>

				<h4><strong>Email:</strong></h4>
					<p><i style="margin-right: 0.5em" class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:<?= $user->email ?>"><?= $user->email ?></a></p>

				<h4><strong>Phone:</strong></h4>
					<p><i style="margin-right: 0.5em" class="fa fa-phone" aria-hidden="true"></i>(XXX) XXX-XXXX</p>

			<?php endif; ?>
		</div>
	</div><!-- ends row -->
</div><!-- ends container -->


<!-- shows other ads certain user has posted -->
<div class="container">
	<?php if(count($otherAds) > 1):?> <!-- if user has posted only one ad, don't show 'Other Ads' -->
		<?php if (Auth::id() == $showItem->user_id) : ?> <!-- if you're logged in and it's your post, then it will read 'Other Ads Posted By You' -->
			<h2 style="font-size: 1.5em" class="text-center"><strong>Other Ads Posted By You</strong></h2>
		<?php else : ?> <!-- else it'll read 'Other Ads Posted By (username)' -->
			<h2 style="font-size: 1.5em" class="text-center"><strong>Other Ads Posted By <?= $user->username ?></strong></h2>
		<?php endif?>
	<?php endif;?>
	<div class="row" id="itemsPage">
		<?php foreach($otherAds as $otherAd) : ?>
			<?php if ($showItem->id != $otherAd->id) : ?> <!-- to show other ads by user, different from the one already shown on main show page -->
				<div class="col-sm-4">
					<a href="/show?id=<?= $otherAd->id ?>" id="items">
						<div class="panel panel-primary" >
							<div class="panel-heading" id="itemsPanelColor"><?= $otherAd->title ?><div class="pull-right"><?= "$" . $otherAd->price ?></div></div>
							<div class="panel-body"><img src=<?= "$otherAd->image" ?> class="img-responsive" id="itemsImages" alt="Image"></div>
							<div class="panel-footer"><?= substr($otherAd->description, 0, 25) . "..." ?></div>
						</div>
					</a>
				</div>
			<?php endif?>
		<?php endforeach; ?>
	</div>
</div>


	<!-- Deleting Ad Modal -->
	<div id="deleteAd" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Deleting Ad</h4>
				</div>
				<div class="modal-body">
					<form  method="POST" action="/delete">
						<div class="row control-group">
							<div class="form-group col-xs-12 floating-label-form-group controls">
								<label>Title: </label>
								<p><?=$showItem->title?></p>
							</div>
						</div>
						<div class="row control-group">
							<div class="form-group col-xs-12 floating-label-form-group controls">
								<label>Price: </label>
								<p><?="$".$showItem->price?></p>
							</div>
						</div>
						<div class="row control-group">
							<div class="form-group col-xs-12 floating-label-form-group controls">
								<label>Location: </label>
								<p><?=$showItem->location?></p>
							</div>
						</div>
						<div class="row control-group">
							<div class="form-group col-xs-12 floating-label-form-group controls">
								<label>Description: </label>
								<p><?=$showItem->description?></p>
							</div>
						</div>
						<div class="modal-footer">
							<input type=hidden name="id" value= "<?=$showItem->id?>">
							<button type="submit" class="btn btn-default btn-success">Confirm Delete</button>
							<button type="submit" data-dismiss="modal" class="btn btn-default btn-danger">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>




	<!-- Editing Ad Modal -->
	<div id="editAd" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Editing Ad</h4>
				</div>
				<div class="modal-body">
					<form  method="POST">
						<div class="row control-group">
							<div class="form-group col-xs-12 floating-label-form-group controls">
								<label>Title: </label>
								<input value="<?=$showItem->title?>" name="title" type="text" class="form-control" placeholder="Title" required data-validation-required-message="Please enter the ad title.">
								<p class="help-block text-danger"></p>
							</div>
						</div>
						<div class="row control-group">
							<div class="form-group col-xs-12 floating-label-form-group controls">
								<label>Location: </label>
								<input value="<?=$showItem->location?>" name="location" type="text" class="form-control" placeholder="Location" required data-validation-required-message="Please enter the ad location.">
								<p class="help-block text-danger"></p>
							</div>
						</div>
						<div class="row control-group">
							<div class="form-group col-xs-12 floating-label-form-group controls">
								<label>Price ($US Dollars): </label>
								<input value="<?=$showItem->price?>" name="price" type="text" class="form-control" placeholder="ex: 1111.11" required data-validation-required-message="Please enter the ad's price.">
								<p class="help-block text-danger"></p>
							</div>
						</div>
						<div class="row control-group">
							<div class="form-group col-xs-12 floating-label-form-group controls">
								<label>Description: </label>
								<textarea rows="4" class="form-control" name="description" placeholder="Description" required data-validation-required-message="Please enter a description of the ad."><?=$showItem->description?></textarea>
								<p class="help-block text-danger"></p>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-default btn-success">Update Ad</button>
							<button type="submit" data-dismiss="modal" class="btn btn-default btn-danger">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
