const employeeId = $('input[id=employee-input]').val();

const getSelectedShipmentRows = () => {
    let shipmentIds = [];
    $('#booksReceiveTable tr.selected').each(function () {
        shipmentIds.push($(this).find('td').attr('data-id'));
    });
    return shipmentIds;
};

const initializeBooksReceiveTable = () => {
    $('#booksReceiveTable').DataTable({
        select: {style: 'multi'},
        columnDefs: [{"width": "25%", "targets": 2}],
        'pageLength': 5
    });
};

const receiveShipmentRequest = (selectedItems) => {
    let url = 'service/employee_index.php?employeeId=' + employeeId + '';
    $.post(url, {shipmentItems: selectedItems}, function (response) {
        actions.receive().modalId.modal('hide');
        if (response.length > 0) {
            actions.receive().btn.attr('disabled', true);
            reloadPage('employee-index.php', 2, $('#receiveRefreshSeconds'));
        }
    });
};

const actions = {
    receive: function () {
        return {
            btn: $('#add-to-inventory'),
            modalId: $('#receiveShipmentModal')
        };
    }
};

const confirmReceivingShipment = () => {
    actions.receive().btn.click(function () {
        if (getSelectedShipmentRows().length === 0) {
            alert('Please select shipments to receive.');
            return false;
        }
        actions.receive().modalId.modal('show');
        actions.receive().modalId.find('#receiveSaveChanges').click(function () {
            console.log('selected', getSelectedShipmentRows());
            receiveShipmentRequest(getSelectedShipmentRows())
        });
    });
};

