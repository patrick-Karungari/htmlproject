<?php

?>
<head>

    <!--BEGIN: PROFILE STYLESHEET-->
    <!-- BEGIN: Vendor CSS -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/vendors/css/forms/select/select2.min.css') ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/vendors/css/editors/quill/katex.min.css') ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/vendors/css/editors/quill/monokai-sublime.min.css') ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/vendors/css/editors/quill/quill.snow.css') ?>">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/css/core/menu/menu-types/vertical-menu.css') ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/css/plugins/forms/form-quill-editor.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/pages/page-blog.css') ?>">
    <!-- END: Page CSS-->
    <!-- END: PROFILE STYLESHEET --->
    <?php
    $array = ['assets/vendors/js/forms/select/select2.full.min.js',
        'assets/vendors/js/editors/quill/katex.min.js',
        'assets/vendors/js/editors/quill/highlight.min.js',
        'assets/vendors/js/editors/quill/quill.min.js'];

    foreach ($array as $script) {
        echo "<script src='" . base_url($script) . "'></script>\n";
    }

    ?>

</head>
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Blog Edit</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/blog') ?>">Blog</a>
                        </li>
                        <li class="breadcrumb-item active">Edit
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
            <div class="dropdown">
                <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                            data-feather="grid"></i></button>
                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i
                                class="mr-1" data-feather="check-square"></i><span
                                class="align-middle">Todo</span></a><a
                            class="dropdown-item" href="app-chat.html"><i class="mr-1"
                                                                          data-feather="message-square"></i><span
                                class="align-middle">Chat</span></a><a class="dropdown-item"
                                                                       href="app-email.html"><i class="mr-1"
                                                                                                data-feather="mail"></i><span
                                class="align-middle">Email</span></a><a class="dropdown-item"
                                                                        href="app-calendar.html"><i class="mr-1"
                                                                                                    data-feather="calendar"></i><span
                                class="align-middle">Calendar</span></a></div>
            </div>
        </div>
    </div>
</div>

<!-- Blog Edit -->
<div class="blog-edit-wrapper">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="avatar mr-75">
                            <img src="<?php echo $current_user->avatarUrl ?>"
                                 width="38" height="38" alt="Avatar"/>
                        </div>
                        <div class="media-body">
                            <h6 class="mb-25"><?php echo $current_user->name ?></h6>
                            <p class="card-text"><?php echo date("M d, Y"); ?></p>
                        </div>
                    </div>
                    <!-- Form -->
                    <form id="blog-create-form" class="mt-2" method="post" name="blog" accept-charset="utf-8">

                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="blog-edit-title">Title</label>
                                    <input type="text" id="blog-edit-title" class="form-control"
                                           name="title"
                                           required
                                           value="The Best Features Coming to iOS and Web design"/>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="blog-edit-category">Category</label>
                                    <select id="blog-edit-category" class="select2 form-control" multiple>
                                        <option value="Fashion" selected>Fashion</option>
                                        <option value="Food">Food</option>
                                        <option value="Gaming" selected>Gaming</option>
                                        <option value="Quote">Quote</option>
                                        <option value="Video">Video</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="blog-edit-slug">Slug</label>
                                    <input type="text" id="blog-edit-slug" class="form-control"
                                           name="slug"
                                           required
                                           value="the-best-features-coming-to-ios-and-web-design"/>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group mb-2">
                                    <label for="blog-edit-status">Status</label>
                                    <select class="form-control" id="blog-edit-status">
                                        <option value="Published">Published</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Draft">Draft</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group mb-2">
                                    <label>Content</label>
                                    <div id="blog-editor-wrapper">
                                        <div id="blog-editor-container">
                                            <div class="editor">
                                                <p>
                                                    Cupcake ipsum dolor sit. Amet dessert donut candy
                                                    chocolate
                                                    bar cotton dessert candy
                                                    chocolate. Candy muffin danish. Macaroon brownie jelly
                                                    beans
                                                    marzipan cheesecake oat cake.
                                                    Carrot cake macaroon chocolate cake. Jelly brownie
                                                    jelly.
                                                    Marzipan pie sweet roll.
                                                </p>
                                                <p><br/></p>
                                                <p>
                                                    Liquorice dragée cake chupa chups pie cotton candy
                                                    jujubes
                                                    bear claw sesame snaps. Fruitcake
                                                    chupa chups chocolate bonbon lemon drops croissant
                                                    caramels
                                                    lemon drops. Candy jelly cake
                                                    marshmallow jelly beans dragée macaroon. Gummies sugar
                                                    plum
                                                    fruitcake. Candy canes candy
                                                    cupcake caramels cotton candy jujubes fruitcake.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="border rounded p-2">
                                    <h4 class="mb-1">Featured Image</h4>
                                    <div class="media flex-column flex-md-row">
                                        <img src="<?php echo base_url('assets/images/slider/03.jpg') ?>"
                                             id="blog-feature-image" class="rounded mr-2 mb-1 mb-md-0"
                                             width="170" height="110" alt="Blog Featured Image"/>
                                        <div class="media-body">
                                            <small class="text-muted">Required image</small>
                                            <p class="my-50">
                                                <a href="javascript:void(0);" id="blog-image-text"></a>
                                            </p>
                                            <div class="d-inline-block">
                                                <div class="form-group mb-0">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                               required
                                                               name="avatar"
                                                               id="blogCustomFile" accept="image/*"/>
                                                        <label class="custom-file-label"
                                                               for="blogCustomFile">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-50">
                                <button type="submit" id="submit" class="btn btn-primary mr-1">Save Changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </div>
                        <input name="description" hidden id="text"/>


                    </form>
                    <!--/ Form -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Blog Edit -->


<script>


    document.getElementById("blog-create").className += " active";

</script>