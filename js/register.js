const registerFormId = $('#registerForm');
const formData = {
    registerForm: function () {
        return {
            fullName: $('input[id=fullName]').val(),
            email: $('input[id=inputEmail]').val(),
            ssn: $('input[id=inputSSN]').val(),
            phone: $('input[id=inputPhone]').val(),
            address: {
                inputAddress: $('input[id=inputAddress]').val(),
                inputCity: $('input[id=inputCity]').val(),
                inputProvince: $('#inputProvince').val(),
                inputPostalCode: $('input[id=inputPostalCode]').val()
            },
            password: $('input[id=inputPassword]').val(),
            confirmPassword: $('input[id=inputConfirmPassword]').val(),
            registerAs: $('input[id=registerAs]').val()
        }
    }
};
const isValidAddress = function () {
    const addressValues = Object.values(formData.registerForm().address);
    const addressKeys = Object.keys(formData.registerForm().address);
    let count = 0;
    let invalidAddressInput = [];
    let cond = false;
    addressValues.map(function (v, i) {
        if (v === "") {
            count++;
            invalidAddressInput.push(addressKeys[i])
        }
    });
    if (count !== 0 && count <= 3) {
        invalidAddressInput.map(function (t) {
            $('#' + t).addClass('custom-is-invalid');
        });
        cond = false;
    } else {
        addressKeys.map(function (t) {
            $('#' + t).removeClass('custom-is-invalid');
        });
        cond = true;
    }
    return cond;
};
const isValidPassword = function () {
    const confirmPasswordLabel = $('#inputConfirmPassword');
    if (formData.registerForm().confirmPassword !== formData.registerForm().password) {
        alert('Password not match!');
        confirmPasswordLabel.addClass('custom-is-invalid');
        return false;
    }
    confirmPasswordLabel.removeClass('custom-is-invalid');
    return true;
};
const registerFormSubmit = function () {
    if (isValidAddress() && isValidPassword()) {
        let url = 'service/customer_create_account.php';
        if (formData.registerForm().registerAs === "employee") {
            if (formData.registerForm().ssn !== "") {
                url = 'service/employee_create_account.php';
            } else {
                alert("SSN cannot be empty");
                return;
            }
        }
        $.post(url, formData.registerForm(), function (response) {
            let res = JSON.parse(response);
            if (res.result) {
                $('#successMessage').removeClass('d-none');
                scrollTop();
                disableInputSubmit($('input[id=inputRegister]'));
                refreshTimer(3, $('#refreshSeconds'), function () {});
            } else {
                alert('There is already an account associated with this email.');
            }
        });
    }
};
$(document).ready(function () {
    $(registerFormId).submit(function (event) {
        event.preventDefault();
        registerFormSubmit();
        return false;
    });
});