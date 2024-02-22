<div class="modal-dialog" role="document">
    <div class="modal-content">

        {!! Form::open([
            'url' => action('ProductClassController@store'),
            'method' => 'post',
            'id' => $quick_add ? 'quick_add_product_class_form' : 'product_class_add_form',
        ]) !!}

        <div
            class="modal-header position-relative border-0 d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">


            <h4 class="modal-title  px-2 position-relative">
                @if (session('system_mode') == 'restaurant')
                    @lang('lang.add_category')
                @else
                    @lang('lang.add_class')
                @endif
                <span class=" header-modal-pill"></span>
            </h4>
            <button type="button"
                class="close btn btn-danger d-flex justify-content-center align-items-center rounded-circle text-white"
                data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <span class="position-absolute modal-border"></span>
        </div>

        <div
            class="modal-body row @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif align-items-center">
            <div class="col-sm-6 mb-2">
                {!! Form::label('name', __('lang.name') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                <div class="input-group my-group select-button-group">
                    {!! Form::text('name', null, [
                        'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                        'placeholder' => __('lang.name'),
                        'required',
                    ]) !!}
                    <span class="input-group-btn">
                        <button class="select-button btn-flat translation_btn" type="button"
                            data-type="product_class"><i class="dripicons-web"></i></button>
                    </span>
                </div>
            </div>
            @include('layouts.partials.translation_inputs', [
                'attribute' => 'name',
                'translations' => [],
                'type' => 'product_class',
            ])
            <input type="hidden" name="quick_add" value="{{ $quick_add }}">
            <div class="col-sm-6 mb-2">
                {!! Form::label('description', __('lang.description'), [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::text('description', null, [
                    'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                    'placeholder' => __('lang.description'),
                ]) !!}
            </div>
            <div class="col-sm-6 mb-2">
                {!! Form::label('sort', __('lang.sort') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                {!! Form::number('sort', 1, [
                    'class' => 'form-control modal-input app()->isLocale("ar") ? text-end : text-start',
                    'placeholder' => __('lang.sort'),
                    'required',
                ]) !!}
            </div>
            <div class="col-md-6 d-flex flex-column mb-2">
                {!! Form::label(null, __('lang.image') . '*', [
                    'class' => 'form-label d-block mb-1 app()->isLocale("ar") ? text-end : text-start',
                ]) !!}
                <div
                    class="d-flex justify-content-between align-items-center @if (app()->isLocale('ar')) flex-row-reverse @else flex-row @endif">

                    <div class="variants  col-md-6">
                        <div class='file file--upload w-100'>
                            <label for='file-class-input' class="w-100 modal-input m-0">
                                <i class="fas fa-cloud-upload-alt"></i>
                            </label>
                            <!-- <input  id="file-input" multiple type='file' /> -->
                            <input type="file" id="file-class-input">
                        </div>
                    </div>

                    <div class="col-md-6 d-flex justify-content-center">
                        <div class="preview-class-container"></div>
                    </div>
                </div>

                {{--                                                            <input type="file" id="projectinput2" --}}
                {{--                                                                   class="form-control img" name="image" accept="image/*" /> --}}
                {{--                                                                   <img src="{{ asset('images/logo.png') }}" alt="" class="img-thumbnail img-preview " style="width: 100px"> --}}
                @error('image')
                    <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-sm-6 d-flex justify-content-end align-items-center">
                <div class="i-checks">
                    <input id="status" name="status" type="checkbox" checked value="1"
                        class="form-control-custom">
                    <label for="status"><strong>
                            @lang('lang.active')
                        </strong></label>
                </div>
            </div>
            {{--            @include('layouts.partials.image_crop') --}}


        </div>
        <div id="cropped_product_class_images"></div>
        <div class="modal-footer d-flex justify-content-center align-content-center gap-3">
            <button id="create-product-class-btn" class="col-3 py-1 btn btn-main">@lang('lang.save')</button>
            <button type="button" class="col-3 py-1 btn btn-danger" data-dismiss="modal">@lang('lang.close')</button>
        </div>

        {!! Form::close() !!}
        <div class="modal fade" id="exampleClassModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleClassModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleClassModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="croppie-class-modal" style="display:none">
                            <div id="croppie-class-container"></div>
                            <button data-dismiss="modal" id="croppie-class-cancel-btn" type="button"
                                class="btn btn-secondary"><i class="fas fa-times"></i></button>
                            <button id="croppie-class-submit-btn" type="button" class="btn btn-primary"><i
                                    class="fas fa-crop"></i></button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
<script>
    $("#create-product-class-btn").click(function(e) {
        e.preventDefault();
        getClassImages()
        setTimeout(() => {
            $("#product_class_add_form").submit();
            $("#quick_add_product_class_form").submit();
        }, 500)
    });
    var fileClassInput = document.querySelector('#file-class-input');
    var previewClassContainer = document.querySelector('.preview-class-container');
    var croppieClassModal = document.querySelector('#croppie-class-modal');
    var croppieClassContainer = document.querySelector('#croppie-class-container');
    var croppieClassCancelBtn = document.querySelector('#croppie-class-cancel-btn');
    var croppieClassSubmitBtn = document.querySelector('#croppie-class-submit-btn');
    // let currentFiles = [];
    fileClassInput.addEventListener('change', () => {
        previewClassContainer.innerHTML = '';
        let files = Array.from(fileClassInput.files)
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            console.log(file);
            let fileType = file.type.slice(file.type.indexOf('/') + 1);
            let FileAccept = ["jpg", "JPG", "jpeg", "JPEG", "png", "PNG", "BMP", "bmp"];
            // if (file.type.match('image.*')) {
            if (FileAccept.includes(fileType)) {
                const reader = new FileReader();
                reader.addEventListener('load', () => {
                    const preview = document.createElement('div');
                    preview.classList.add('preview');
                    const img = document.createElement('img');
                    const actions = document.createElement('div');
                    actions.classList.add('action_div');
                    img.src = reader.result;
                    preview.appendChild(img);
                    preview.appendChild(actions);
                    const container = document.createElement('div');
                    const deleteBtn = document.createElement('span');
                    deleteBtn.classList.add('delete-btn');
                    deleteBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-trash"></i>';
                    deleteBtn.addEventListener('click', () => {
                        Swal.fire({
                            title: '{{ __('site.Are you sure?') }}',
                            text: "{{ __("site.You won't be able to delete!") }}",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire(
                                    'Deleted!',
                                    '{{ __('site.Your Image has been deleted.') }}',
                                    'success'
                                )
                                files.splice(file, 1)
                                preview.remove();
                                getClassImages()
                            }
                        });
                    });
                    preview.appendChild(deleteBtn);
                    const cropBtn = document.createElement('span');
                    cropBtn.setAttribute("data-toggle", "modal")
                    cropBtn.setAttribute("data-target", "#exampleClassModal")
                    cropBtn.classList.add('crop-btn');
                    cropBtn.innerHTML = '<i style="font-size: 20px;" class="fas fa-crop"></i>';
                    cropBtn.addEventListener('click', () => {
                        setTimeout(() => {
                            launchClassCropTool(img);
                        }, 500);
                    });
                    preview.appendChild(cropBtn);
                    previewClassContainer.appendChild(preview);
                });
                reader.readAsDataURL(file);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: '{{ __('site.Oops...') }}',
                    text: '{{ __('site.Sorry , You Should Upload Valid Image') }}',
                })
            }
        }

        getClassImages()
    });

    function launchClassCropTool(img) {
        // Set up Croppie options
        const croppieOptions = {
            viewport: {
                width: 200,
                height: 200,
                type: 'square' // or 'square'
            },
            boundary: {
                width: 300,
                height: 300,
            },
            enableOrientation: true
        };

        // Create a new Croppie instance with the selected image and options
        const croppie = new Croppie(croppieClassContainer, croppieOptions);
        croppie.bind({
            url: img.src,
            orientation: 1,
        });

        // Show the Croppie modal
        croppieClassModal.style.display = 'block';

        // When the user clicks the "Cancel" button, hide the modal
        croppieClassCancelBtn.addEventListener('click', () => {
            croppieClassModal.style.display = 'none';
            $('#exampleClassModal').modal('hide');
            croppie.destroy();
        });

        // When the user clicks the "Crop" button, get the cropped image and replace the original image in the preview
        croppieClassSubmitBtn.addEventListener('click', () => {
            croppie.result({
                type: 'canvas',
                size: {
                    width: 800,
                    height: 600
                },
                quality: 1 // Set quality to 1 for maximum quality
            }).then((croppedImg) => {
                img.src = croppedImg;
                croppieClassModal.style.display = 'none';
                $('#exampleClassModal').modal('hide');
                croppie.destroy();
                getClassImages()
            });
        });
    }

    function getClassImages() {
        setTimeout(() => {
            const container = document.querySelectorAll('.preview-class-container');
            let images = [];
            $("#cropped_product_class_images").empty();
            for (let i = 0; i < container[0].children.length; i++) {
                images.push(container[0].children[i].children[0].src)
                var newInput = $("<input>").attr("type", "hidden").attr("name", "cropImages[]").val(container[0]
                    .children[i].children[0].src);
                $("#cropped_product_class_images").append(newInput);
            }
            return images
        }, 300);
    }
</script>
