import $ from "jquery";
import { submitForm, fetchData } from "./components/backendRequest";



$(function () {
    submitForm();

    fetchData('/home')
        .then((response) => {
            $('h1').text(response.title);
            $('title').text(response.title);
            $()
        })
        .catch(error => {
            console.error('Error:', error);
        });
})