<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */
?>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Create Investment Plan</h4>

        <form class="forms-sample" method="post" action="">
            <input type="hidden" name="id" value="<?php echo $plan->id; ?>">
            <div class="form-group">
                <label for="exampleInputUsername1">Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo old('title', $plan->title) ?>" required id="exampleInputUsername1" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Days</label>
                <input type="number" min="1" class="form-control" name="days" value="<?php echo old('days', $plan->days) ?>" required id="exampleInputEmail1" placeholder="Days">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Returns (%)</label>
                <input type="number" min="0" class="form-control" name="returns" value="<?php echo old('returns', $plan->returns) ?>" required id="exampleInputPassword1" placeholder="Returns as a percentage">
            </div>
            <div class="form-check form-check-flat form-check-primary">
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="active" value="1" <?php echo old('active', $plan->active) == 1 ? 'checked' : ''; ?>>
                    Activate plan
                    <i class="input-helper"></i></label>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="description" rows="5"><?php echo old('description', $plan->description) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
        </form>
    </div>
</div>
