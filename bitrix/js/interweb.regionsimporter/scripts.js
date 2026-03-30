function runImport(data) {
    $('[name=run_export]').prop("disabled", true);
    $('#progress_service_data').show();
    BX.showWait();
    importIteration(1, data);
}

function importIteration(loop, data) {
    BX.showWait();
    BX.ajax.runAction('interweb:regionsimporter.api.importer.runImport', {
        data: {
            data: data,
            loop: loop
        }
    })
        .then(function (result) {
            BX.closeWait();
            if (result.data.response.status == 'success') {
                $('#progress_service_data').html(result.data.response.progress);

                if (loop < 18) {
                    loop = loop + 1;
                    importIteration(loop, data);
                } else {
                    $('.regions_import_success').show();
                }
            } else {
                $('#progress_service_data').hide();
                alert(BX.message("ERROR") + result.data.response.texterror);
            }

        }, function (result) {
            BX.closeWait();
            $('#progress_service_data').hide();
            alert(BX.message("ERROR") + result);
        });
}

function buildNoMenu() {
    var buffer;
    buffer = BX.message("CHOOSE_IBLOCK");
    BX.closeWait();
}

function ClearSelected() {
    TreeSelected = [];
}

function treeSelect() {
    TreeSelected = [];
}

function collapse(node) {
}


function runAddInfo(data) {
    // $('[name=add_info]').prop("disabled", true);
    BX.showWait();
    addInfoElements(1, data);
}

function addInfoElements(loop, data) {
    BX.showWait();
    BX.ajax.runAction('interweb:regionsimporter.api.importer.runInfo', {
        data: {
            data: data,
            loop: loop
        }
    })
        .then(function (result) {
            BX.closeWait();
            if (result.status == 'success') {
                alert(result.data.response.texterror);
            } else {
                $('#progress_service_data').hide();
                alert(BX.message("ERROR") + result.data.response.texterror);
            }

        }, function (result) {
            BX.closeWait();
            $('#progress_service_data').hide();
            alert(BX.message("ERROR") + result);
        });
}