


BX.folderSizes={
    init:function(){
        BX.addCustomEvent('onAjaxSuccessFinish', BX.delegate(function (config) {
            console.log(config);
            if(config.url.indexOf("fileman_admin.php?")>=0) {
                BX.folderSizes.load();
            }
        }));
    },
    addBtn:function(){
        if(!BX("folder_sizes_update")) {
            var paneles = BX.findChild(BX("tbl_fileman_admin_result_div"), {
                "tag": "div",
                "class": "adm-list-table-wrap"
            }, false, true);
            console.log(paneles);
            paneles = BX.findChild(paneles[0], {"tag": "div",}, false, true);

            paneles[1].innerHTML += '<a href="javascript:void(0);" class="adm-btn" id="folder_sizes_update" title="Обновить размеры папок" onclick="BX.folderSizes.load(true)">Обновить размеры</a>';
        }
    },
    load:function(force){
        BX.folderSizes.addBtn();
        var filePath=BX("quick_path").value;
        var filesOnPage={};

        var tbl=BX("tbl_fileman_admin");
        var positions={'size':"",'name':"",};
        var nameList=[];
        var headers=BX.findChild(tbl.children[0].children[0], {
            "tag" : "td", },false,true);
        for (var j in headers){
            if(headers[j]!=undefined&&headers[j].innerText.trim()=="Размер файла"){
                positions.size=j;
            }
            if(headers[j]!=undefined&&(headers[j].innerText.trim()=="Имя"||headers[j].innerText.trim()=="Имя файла (папки)")){
                positions.name=j;
            }
        }
        if(positions.name!=""&&positions.size!="") {
            var trList = BX.findChild(tbl.children[1], {
                "tag": "tr",
            }, false, true)

            for (var j in trList) {
                let tdList = BX.findChild(trList[j], {
                    "tag": "td",
                }, false, true);

                let objData = {'name': "", "tag": ""};
                for (var i in tdList) {
                    if (i == positions.name) {
                        objData.name = tdList[i].innerText.trim();
                        nameList.push(tdList[i].innerText.trim());
                    }
                    if (i == positions.size) {
                        objData.tag = tdList[i];
                    }
                }
                filesOnPage[objData.name] = objData;
            }

            if(force) {
                var waiter = BX.showWait();
            }
            BX.ajax({
                url: '/bitrix/admin/kitnet_folder_get_ajax_size.php',
                data: {'path': filePath,'files':nameList,'force':force},
                method: 'POST',
                dataType: 'json',
                timeout: 10,
                async: true,
                processData: true,
                scriptsRunFirst: true,
                emulateOnload: true,
                start: true,
                cache: false,
                onsuccess: function (result) {
                    if(force) {
                        BX.closeWait('',waiter);
                    }
                    if (result.result != undefined && result.result == "success") {
                        for (var i in result.list) {
                            if (filesOnPage[result.list[i].NAME] != undefined) {
                                filesOnPage[result.list[i].NAME].tag.innerText = result.list[i].FORMAT_SIZE;
                            }
                        }
                    }

                },
                onfailure: function (result) {
                    console.error("Folder sizes connection error");
                }
            });

        }

    }
}


document.addEventListener("DOMContentLoaded", function(){
    BX.folderSizes.init();
    BX.folderSizes.load();
})