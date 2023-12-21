'use strict';
import $ from "jquery";
import axios from "axios";
import { bsAlert } from "./alerts";


/**
 * Submits a form to the specified URL using the provided class name.
 *
 * @param {string} url - The URL to which the form should be submitted.
 * @param {string} className - The class name of the form to be submitted.
 */
export const submitForm = (url, className) => {
    $(`.${className}`).on('submit', function (e) {
        e.preventDefault();

        let formID = $(this).attr("id");
        let formStatus = $("#" + formID + " > .form-status");

        let formData = new FormData(this);

        $.ajax({
            url: url,
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                // loading....
                formStatus.html("<div class='spinner-grow' role='status'></div>");
            },
            success: function (response) {
                console.log(response);
                if (response.indexOf("successfully") > 0) {
                    formStatus.html(bsAlert("success", response));
                } else {
                    formStatus.html(bsAlert("danger", response));
                }
            },
            error: function (xhr, thrownError) {
                formStatus.html(bsAlert("danger", thrownError));
            },
            complete: function () {
                console.log("complete");
            },
        });
    })
}

/**
 * 
 * @param {string} url 
 * @returns 
 */

export const fetchData =  (url) => {
    return axios.get(`${url}`)
        .then(function (response) {
            // handle success
            return response.data;
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
}
