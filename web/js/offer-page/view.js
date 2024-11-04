import { OfferDomain as OfferModel } from "../domains/OfferDomain.js";
import {AlertView}  from "../alert.js"

$(document).ready(function () {
    const editButton = $('.edit-btn');
    const saveButton = $('.save-btn');

    editButton.on('click', function () {
        //Меняем с просмотра на редактирование и наоборот
        toggleEdit(true);
    });

    saveButton.on('click', function () {
        //Заполняем модель данными со страницы
        let model = new OfferModel(
            $('.offer-id').text(),
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

    function toggleEdit(isEditing) {
        $('.offer-title').toggle(!isEditing);
        $('.offer-title-input').toggle(isEditing);
        $('.offer-email').toggle(!isEditing);
        $('.offer-email-input').toggle(isEditing);
        $('.offer-phone').toggle(!isEditing);
        $('.offer-phone-input').toggle(isEditing);

        editButton.toggle(!isEditing);
        saveButton.toggle(isEditing);
    }

    function Ajax($model) {
        //Отправляем модель на создание
        $.ajax({
            url: `update/${$model.id}`,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify($model),
            success: function(response) {
                response = JSON.parse(response)

                if (response.success) {
                    $('.offer-title').text(response.model.title);
                    $('.offer-email').text(response.model.email);
                    $('.offer-phone').text(response.model.phone);

                    $('.offer-title-input').val(response.model.title);
                    $('.offer-email-input').val(response.model.email);
                    $('.offer-phone-input').val(response.model.phone);

                    toggleEdit(false);

                    new AlertView.successWindowShow($('.error'), response.message)
                }
            },
            error: function(xhr) {
                let message = JSON.parse(xhr.responseJSON.message);
                new AlertView.errorWindowShow($('.error'), JSON.stringify(message.error.message))
                toggleEdit(false);
            }
        });
    }
});