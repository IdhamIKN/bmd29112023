import Pristine from "pristinejs";
import Toastify from "toastify-js";

(function () {
    "use strict";

    function onSubmit(pristine) {
        let valid = pristine.validate();

        if (valid) {
            Toastify({
                node: $("#success-notification-content")
                    .clone()
                    .removeClass("hidden")[0],
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
            }).showToast();
            $('form.validate-form').submit();
        } else {
            Toastify({
                node: $("#failed-notification-content")
                    .clone()
                    .removeClass("hidden")[0],
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
            }).showToast();
        }
    }

    $(".validate-form").each(function () {
        let pristine = new Pristine(this, {
            classTo: "input-form",
            errorClass: "has-error",
            errorTextParent: "input-form",
            errorTextClass: "text-danger mt-2",
        });

        pristine.addValidator(
            $(this).find('input[type="url"]')[0],
            function (value) {
                let expression =
                    /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/gi;
                let regex = new RegExp(expression);
                if (!value.length || (value.length && value.match(regex))) {
                    return true;
                }
                return false;
            },
            "This field is URL format only",
            2,
            false
        );

        $(this).on("submit", function (e) {
            e.preventDefault();
            onSubmit(pristine);
        });
    });

    // $(".validate-form11").each(function() {
    //     let pristine = new Pristine(this, {
    //         classTo: "input-form"
    //         , errorClass: "has-error"
    //         , errorTextParent: "input-form"
    //         , errorTextClass: "text-danger mt-2"
    //     , });

    //     pristine.addValidator(
    //         $(this).find('input[type="url"]')[0]
    //         , function(value) {
    //             let expression =
    //                 /[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)?/gi;
    //             let regex = new RegExp(expression);
    //             if (!value.length || (value.length && value.match(regex))) {
    //                 return true;
    //             }
    //             return false;
    //         }
    //         , "This field is URL format only"
    //         , 2
    //         , false
    //     );

    //     $(this).on("submit", function(e) {
    //         e.preventDefault();
    //         console.log("Form submitted");

    //         // Serialize form data into a format that can be sent to the server
    //         let formData = $(this).serialize();

    //         // Send an AJAX request to the server-side script
    //         $.ajax({
    //             type: "POST", // or "GET" depending on your server-side script
    //             url: "{{ route('storeregister') }}", // Update with the correct URL
    //             data: formData
    //             , success: function(response) {
    //                 console.log("Form data submitted successfully");
    //                 console.log(response); // You can handle the response from the server here
    //             }
    //             , error: function(error) {
    //                 console.error("Error submitting form data");
    //                 console.error(error); // You can handle errors here
    //             }
    //         , });
    //     });
    // });
})();
