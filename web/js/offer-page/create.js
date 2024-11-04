import { OfferDomain as OfferModel } from "../domains/OfferDomain.js";
import {AlertView}  from "../alert.js"

$(document).ready(function () {
    const saveButton = $('.save-btn');

    saveButton.on('click', function () {
        //Заполняем модель данными со страницы
        let model = new OfferModel(
            null,
            $('.offer-title-input').val(),
            $('.offer-email-input').val(),
            $('.offer-phone-input').val()
        );

        if (!model.validation.valid) {
            new AlertView.errorWindowShow($('.error'), model.validation.message)
        } else {
            Ajax(model);
        }
    });

    function Ajax($model) {
        //Отправляем модель на создание
        $.ajax({
            url: `create`,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify($model),
            success: function(response) {
                response = JSON.parse(response)

                if (response.success) {
                    new AlertView.successWindowShow($('.error'), response.message)
                    //Редиректим на обзор то что создали, если не надо, можно и удалить
                    window.location.replace(`${response.url}`);
                }
            },
            error: function(xhr) {
                let message = JSON.parse(xhr.responseJSON.message);
                new AlertView.errorWindowShow($('.error'), JSON.stringify(message.error.message))
            }
        });
    }
});