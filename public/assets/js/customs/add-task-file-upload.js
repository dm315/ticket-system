/**
 * File Upload
 */

'use strict';

(function () {
    // previewTemplate: Updated Dropzone default previewTemplate
    // ! Don't change it unless you really know what you are doing
    const previewTemplate = `<div class="dz-preview dz-file-preview">
                                             <div class="dz-details">
                                      <div class="dz-thumbnail">
                                        <img data-dz-thumbnail>
                                        <span class="dz-nopreview">بدون پیش نمایش</span>
                                        <div class="dz-success-mark"></div>
                                        <div class="dz-error-mark"></div>
                                        <div class="dz-error-message"><span data-dz-errormessage></span></div>
                                        <div class="progress">
                                          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
                                        </div>
                                      </div>
                                      <div class="dz-filename" data-dz-name></div>
                                      <div class="dz-size" data-dz-size></div>
                                    </div>
                                     </div>`;

    // ? Start your code from here
    // Multiple Dropzone
    // --------------------------------------------------------------------
    if (document.getElementById('dropzone-multi')) {
        const dropzoneMulti = new Dropzone('div#dropzone-multi', {
            url: '/upload',
            previewTemplate: previewTemplate,
            maxFiles: 3,
            parallelUploads: 1,
            acceptedFiles: '.jpg,.jpeg,.png',
            maxFilesize: 3000000,
            addRemoveLinks: true
        });
    }
})();
