<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

 //dd($plan);

?>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Investment Plan</h4>

        <form class="forms-sample" method="post" action="plans">
            <input type="hidden" name="id" value="<?php  echo $plan->id; ?>">
            <div class="form-group">
                <label for="exampleInputUsername1">Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo old('title', $plan->title) ?>"
                    required id="exampleInputUsername1" placeholder="Title">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Days</label>
                <input type="number" min="1" class="form-control" name="days"
                    value="<?php echo old('days', $plan->days) ?>" required id="exampleInputEmail1" placeholder="Days">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Returns (%)</label>
                <input type="number" min="0" class="form-control" name="returns"
                    value="<?php echo old('returns', $plan->returns) ?>" required id="exampleInputPassword1"
                    placeholder="Returns as a percentage">
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox ">
                    <input type="checkbox" class="custom-control-input " id="customCheck1" name="active"
                        <?php echo old('active', $plan->active) == 1 ? 'checked' : '';?> />
                    <label class="custom-control-label" for="customCheck1">Activate plan</label>
                </div>
            </div>
            <div class="form-group mb-2">
                <label class="form-label" for="user-plan">Description</label>
                <div class="form-label-group mt-2 mb-0">
                    <textarea data-length="200" class="form-control char-textarea" name="description"
                        id="textarea-counter" rows="5"
                        placeholder="Plan Description"><?php echo old('description', $plan->description) ?></textarea>
                    <label for="textarea-counter">Plan Description</label>
                </div>
                <small class="textarea-counter-value float-right"><span class="char-count">0</span> / 200
                </small>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
        </form>
    </div>
</div>
