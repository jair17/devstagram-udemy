import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Upload your images here',
    acceptedFiles: ".png,.jpg,.jpeg,.gif",
    addRemoveLinks: true,
    dictRemoveFile: 'Delete file',
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        if (document.querySelector('[name="image"]').value.trim()) {
            const imgPublished = {}
            imgPublished.size = 1234
            imgPublished.name = document.querySelector('[name="image"]').value
            this.options.addedfile.call(this, imgPublished)
            this.options.thumbnail.call(this, imgPublished, `/uploads/${imgPublished.name}`)
            imgPublished.previewElement.classList.add('dz-success', 'dz-complete')
        }
    },
});
dropzone.on('success', function (file, response) {

    document.querySelector('[name="image"]').value = response.image

});
dropzone.on('removedfile', function (file) {
    if (file.status === "success") {
        document.querySelector('[name="image"]').value = "";
    }
});



