const warnMessage = $('#warningMessage');

const customerLoginForm = $('#customerLoginForm');
const customerFormData = {
    getVal: function () {
        return {
            email: $('input[id=inputEmail]').val(),
            password: $('input[id=inputPassword]').val()
        }
    }
};
const customerLoginFormSubmit = function () {
    if (customerFormData.getVal().email !== "" && customerFormData.getVal().password !== "") {
        $.post('service/customer_login.php', customerFormData.getVal(), function (data) {
            let res = JSON.parse(data);
            if (res.result) {
                reloadPage('index.php?indexActive=true', 2, $('#refreshSeconds'));
            } else {
                warnMessage.removeClass('d-none');
                warnMessage.html(res.message);
            }
        });
    }
};

const employeeLoginForm = $('#employeeLoginForm');
const employeeFormData = {
    getVal: function () {
        return {
            email: $('input[id=inputEmpEmail]').val(),
            password: $('input[id=inputEmpPassword]').val()
        }
    }
};
const employeeLoginFormSubmit = function () {
    if (employeeFormData.getVal().email !== "" && employeeFormData.getVal().password !== "") {
        $.post('service/employee_login.php', employeeFormData.getVal(), function (data) {
            let res = JSON.parse(data);
            if (res.result) {
                reloadPage('employee-index.php', 2, $('#refreshSeconds'));
            } else {
                warnMessage.removeClass('d-none');
                warnMessage.html(res.message);
            }
        });
    }
};

const publisherLoginForm = $('#publisherSignInForm');
const publisherFormData = {
    getVal: function () {
        return {
            companyEmail: $('input[id=inputCompanyEmail]').val(),
            password: $('input[id=inputCompanyPassword]').val()
        }
    },
    isValid: function () {
        return this.getVal().companyEmail !== "" && this.getVal().password !== "";
    }
};
const publisherLoginFormSubmit = function () {
    if (publisherFormData.isValid()) {
        $.post('service/publisher_login.php', publisherFormData.getVal(), function (data) {
            let res = JSON.parse(data);
            if (res.result) {
                reloadPage('publisher-dashboard.php', 3, $('#refreshSeconds'));
            } else {
                warnMessage.removeClass('d-none');
                warnMessage.html(res.message);
            }
        });
    } else {
        warnMessage.removeClass('d-none');
        warnMessage.html('Please re-enter the company name and password.');
    }
};

$(document).ready(function () {
    customerLoginForm.submit(function (e) {
        e.preventDefault();
        customerLoginFormSubmit();
        return false;
    });

    employeeLoginForm.submit(function (e) {
        e.preventDefault();
        employeeLoginFormSubmit();
        return false;
    });

    publisherLoginForm.submit(function (e) {
        e.preventDefault();
        publisherLoginFormSubmit();
        return false;
    });
});