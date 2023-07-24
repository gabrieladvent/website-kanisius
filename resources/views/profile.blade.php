
@extends('layout-yayasan.second')
@section('isi-content')
    <div class=" mt-5 py-4 px-5 container-fluid">
        <div class="row mt-5 d-flex justify-content-center">
            <div class="col-3 text-center">
                <img src="{{ asset('/icon/user-tie-solid.svg') }}" width="100px" alt="">
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-3 mt-3 text-center">
                    <p class="fw-bold">{{ $user->id . ' ' . $user->name }} </p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-3 mt-3 text-center">
                    <a href="" class="btn bg-light w-50 ">Edit Tema</a>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-3 mt-3 text-center">
                    <a href="" class="btn bg-light w-50 ">Req Tema</a>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-3 mt-3 mb-12 text-center">
                    <a href="akun-yayasan" class="btn bg-light w-50 ">AKun Yayasan</a>
>>>>>>> 837d8683578a4425a915382bb9540a4250900316
                </div>
            </div> --}}
                <div class="col-4  mt-5 py-4 px-5">
                    <div class="row mt-5 shadow-3-strong">
                        <div class="col mt-3 ms-4  ">
                            <p class="fw-bold"> {{ $user->id }} </p>
                            <p class="fw-bold">{{ $user->name }}</p>
                            <p class="fw-bold">{{ $user->namasekolah }}</p>
                        </div>
                        <div class="col mt-3">
                            <img class="float-end" src="{{ asset('/icon/user-tie-solid.svg') }}" width="100px"
                                alt="">
                        </div>
                    </div>
                </div>
                <div class="col  mt-5 py-4 px-5">
                    <div class="row mt-5 d-flex justify-content-center shadow-3-strong">
                        <div class="col-3 mt-5 mb-3  text-center">
                            <a href="" class="btn bg-light  ">Edit Tema</a>
                            <div class="row  text-center">
                                <a href="akun-yayasan" class="btn bg-light  ">AKun Yayasan</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 py-5 shadow-3-strong">
                        <p class="text-center fs-5">Upload Tema Disini</p>
                        <form>
                            <fieldset class="upload_dropZone text-center mb-2 p-2">
                                <legend class="visually-hidden">Image uploader</legend>
                                <svg class="upload_svg" width="60" height="60" aria-hidden="true">
                                    <use href="#icon-imageUpload"></use>
                                </svg>
                                <p class="small my-2">Drag &amp; Drop tema gambar(s) dengan format png<br><i>or</i>
                                </p>
                                <input id="upload_image_background" data-post-name="image_background"
                                    data-post-url="https://someplace.com/image/uploads/backgrounds/"
                                    class="position-absolute invisible" type="file" multiple accept="image/png" />
                                <label class="btn btn-upload mb-3" for="upload_image_background">Choose
                                    file(s)</label>
                                <div class="upload_gallery d-flex flex-wrap justify-content-center gap-3 mb-0"></div>
                            </fieldset>
                        </form>
                        <svg style="display:none">
                            <defs>
                                <symbol id="icon-imageUpload" clip-rule="evenodd" viewBox="0 0 96 96">
                                    <path
                                        d="M47 6a21 21 0 0 0-12.3 3.8c-2.7 2.1-4.4 5-4.7 7.1-5.8 1.2-10.3 5.6-10.3 10.6 0 6 5.8 11 13 11h12.6V22.7l-7.1 6.8c-.4.3-.9.5-1.4.5-1 0-2-.8-2-1.7 0-.4.3-.9.6-1.2l10.3-8.8c.3-.4.8-.6 1.3-.6.6 0 1 .2 1.4.6l10.2 8.8c.4.3.6.8.6 1.2 0 1-.9 1.7-2 1.7-.5 0-1-.2-1.3-.5l-7.2-6.8v15.6h14.4c6.1 0 11.2-4.1 11.2-9.4 0-5-4-8.8-9.5-9.4C63.8 11.8 56 5.8 47 6Zm-1.7 42.7V38.4h3.4v10.3c0 .8-.7 1.5-1.7 1.5s-1.7-.7-1.7-1.5Z M27 49c-4 0-7 2-7 6v29c0 3 3 6 6 6h42c3 0 6-3 6-6V55c0-4-3-6-7-6H28Zm41 3c1 0 3 1 3 3v19l-13-6a2 2 0 0 0-2 0L44 79l-10-5a2 2 0 0 0-2 0l-9 7V55c0-2 2-3 4-3h41Z M40 62c0 2-2 4-5 4s-5-2-5-4 2-4 5-4 5 2 5 4Z" />
                                </symbol>
                            </defs>
                        </svg>
                        <div class="row">
                            <div class="col mt-1    ">
                                <button class=" float-end fs-6 btn bg-primary text-white">Submit </button>
                            </div>
                        </div>
                    </div>

                </div>
                <<<<<<< HEAD </section>
                    <!--Main layout-->
                    <!-- MDB -->
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
                    <script type="text/javascript" src="{{ asset('/js/popper.js') }}"></script>
                    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
                    <script type="text/javascript" src="{{ asset('/js/mdb.min.js') }}"></script>
                    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
                    <script type="text/javascript" src="{{ asset('/js/addons/datatables.min.js') }}"></script>
                    {{-- <script type="text/javascript" src="{{ asset('/js/js.js') }}"></script> --}}
                    <script>
                        /* Bootstrap 5 JS included */

                        console.clear();
                        ('use strict');


                        // Drag and drop - single or multiple image files
                        // https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
                        // https://codepen.io/joezimjs/pen/yPWQbd?editors=1000
                        (function() {

                            'use strict';

                            // Four objects of interest: drop zones, input elements, gallery elements, and the files.
                            // dataRefs = {files: [image files], input: element ref, gallery: element ref}

                            const preventDefaults = event => {
                                event.preventDefault();
                                event.stopPropagation();
                            };

                            const highlight = event =>
                                event.target.classList.add('highlight');

                            const unhighlight = event =>
                                event.target.classList.remove('highlight');

                            const getInputAndGalleryRefs = element => {
                                const zone = element.closest('.upload_dropZone') || false;
                                const gallery = zone.querySelector('.upload_gallery') || false;
                                const input = zone.querySelector('input[type="file"]') || false;
                                return {
                                    input: input,
                                    gallery: gallery
                                };
                            }

                            const handleDrop = event => {
                                const dataRefs = getInputAndGalleryRefs(event.target);
                                dataRefs.files = event.dataTransfer.files;
                                handleFiles(dataRefs);
                            }


                            const eventHandlers = zone => {

                                const dataRefs = getInputAndGalleryRefs(zone);
                                if (!dataRefs.input) return;

                                // Prevent default drag behaviors
                                ;
                                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(event => {
                                    zone.addEventListener(event, preventDefaults, false);
                                    document.body.addEventListener(event, preventDefaults, false);
                                });

                                // Highlighting drop area when item is dragged over it
                                ;
                                ['dragenter', 'dragover'].forEach(event => {
                                    zone.addEventListener(event, highlight, false);
                                });;
                                ['dragleave', 'drop'].forEach(event => {
                                    zone.addEventListener(event, unhighlight, false);
                                });

                                // Handle dropped files
                                zone.addEventListener('drop', handleDrop, false);

                                // Handle browse selected files
                                dataRefs.input.addEventListener('change', event => {
                                    dataRefs.files = event.target.files;
                                    handleFiles(dataRefs);
                                }, false);

                            }


                            // Initialise ALL dropzones
                            const dropZones = document.querySelectorAll('.upload_dropZone');
                            for (const zone of dropZones) {
                                eventHandlers(zone);
                            }


                            // No 'image/gif' or PDF or webp allowed here, but it's up to your use case.
                            // Double checks the input "accept" attribute
                            const isImageFile = file => ['image/png'].includes(file.type);


                            function previewFiles(dataRefs) {
                                if (!dataRefs.gallery) return;
                                for (const file of dataRefs.files) {
                                    let reader = new FileReader();
                                    reader.readAsDataURL(file);
                                    reader.onloadend = function() {
                                        let img = document.createElement('img');
                                        img.className = 'upload_img mt-2';
                                        img.setAttribute('alt', file.name);
                                        img.src = reader.result;
                                        dataRefs.gallery.appendChild(img);
                                    }
                                }
                            }

                            // Based on: https://flaviocopes.com/how-to-upload-files-fetch/
                            const imageUpload = dataRefs => {

                                // Multiple source routes, so double check validity
                                if (!dataRefs.files || !dataRefs.input) return;

                                const url = dataRefs.input.getAttribute('data-post-url');
                                if (!url) return;

                                const name = dataRefs.input.getAttribute('data-post-name');
                                if (!name) return;

                                const formData = new FormData();
                                formData.append(name, dataRefs.files);

                                fetch(url, {
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        console.log('posted: ', data);
                                        if (data.success === true) {
                                            previewFiles(dataRefs);
                                        } else {
                                            console.log('URL: ', url, '  name: ', name)
                                        }
                                    })
                                    .catch(error => {
                                        console.error('errored: ', error);
                                    });
                            }


                            // Handle both selected and dropped files
                            const handleFiles = dataRefs => {

                                let files = [...dataRefs.files];

                                // Remove unaccepted file types
                                files = files.filter(item => {
                                    if (!isImageFile(item)) {
                                        console.log('Not an image, ', item.type);
                                    }
                                    return isImageFile(item) ? item : null;
                                });

                                if (!files.length) return;
                                dataRefs.files = files;

                                previewFiles(dataRefs);
                                imageUpload(dataRefs);
                            }

                        })();
                    </script>
    </body>

    </html>
    =======
    </div>
    </div>
    </div>
@endsection
>>>>>>> 837d8683578a4425a915382bb9540a4250900316
