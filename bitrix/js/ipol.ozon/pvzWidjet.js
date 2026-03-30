// cityFrom, module's deliveries,key of post where the pvz is,key in post -> where will be data from the module,props for saving chosen pvz,how do we call buttonLabel,iPE - module label,
function ipol_ozon_pvzWidjet(city,deliveries,paysystems,savingInput,postField,pvzPicker,buttonLabel,iPE,LANG,cargo,noYmaps,defPaysys){
    var self     = this;
    var label    = 'Ozon pvzWidjet';
    var pvz      = false;
    var paysys   = false;
    var ready    = false;
    var PAY_SYSTEM_ID  = false;
    var PERSON_TYPE_ID = false;
    var DELIVERY_ID = false;
    var delType     = false;

    this.error = false;

    if(typeof(city) === 'undefined'){
        error('No city given');
        this.error = true;
    }

    // bitrix deliveries for PVZ
    if(typeof(deliveries) !== 'object' || isEmpty(deliveries)){
        error('No module deliveries found');
        this.error = true;
        return false;
    }

    if(typeof(LANG) !== 'object' || isEmpty(LANG)){
        LANG = {
            'WRONG_PAY': 'Incorrect payment system for this pvz'
        };
    }

    if(typeof(noYmaps) !== 'boolean'){
        noYmaps = false;
    }

    // moduleLabel
    if(typeof(iPE) === 'undefined'){
        iPE = 'IPOL_OZON_';
    }

    // where in Request will be saved PVZ
    if(typeof(savingInput) === 'undefined' || !savingInput){
        // savingInput = iPE + 'pickup_PVZ';
        savingInput = 'POINT_GUID';
    }

    if(typeof(buttonLabel) === 'undefined' || !buttonLabel){
        buttonLabel = {
            'pickup' : 'Choose PVZ',
            'postamat' : 'Choose Postamat'
        };
    }

    if(typeof(pvzPicker) === 'undefined')
        pvzPicker = false;

    var oldTemplate = $('#ORDER_FORM').length;

    var currentDelivery = false;

    this.onLoad = function (ajaxAns) {
        if(typeof(ajaxAns) === 'object' && typeof(ajaxAns.order) === 'undefined')
            return;

        var newTemplateAjax = (typeof(ajaxAns) !== 'undefined' && ajaxAns !== null && typeof(ajaxAns[postField]) === 'object');

        if(typeof(ajaxAns) === 'undefined'){
            ajaxAns = false;
        }

        if(newTemplateAjax) {
            if(typeof(ajaxAns[postField]) !== 'undefined'){
                city   = ajaxAns[postField].city;
                paysys = ajaxAns[postField].paysys;
                PAY_SYSTEM_ID = ajaxAns[postField].PAY_SYSTEM_ID;
                PERSON_TYPE_ID = ajaxAns[postField].PERSON_TYPE_ID;
                DELIVERY_ID = ajaxAns[postField].DELIVERY_ID;
                delType = ajaxAns[postField].DELIVERY_TYPE;
            }
        }else{
            var ajaxData = $('#'+postField);
            if(ajaxData.length){
                var saved = $.parseJSON(ajaxData.val());
                city   = saved.city;
                paysys = saved.paysys;
                PAY_SYSTEM_ID = saved.PAY_SYSTEM_ID;
                PERSON_TYPE_ID = saved.PERSON_TYPE_ID;
                DELIVERY_ID = saved.DELIVERY_ID;
                delType = saved.DELIVERY_TYPE;
            }
        }

        widjetController.paytypes = {};

        if(!paysys){
            for(var id in paysystems){
                if(paysysHandler.guess(id)){
                    paysys = paysystems[id];
                }
            }
            if(!paysys){
                paysys = defPaysys;
            }
        }
        if(paysys === 'CARD' || paysys === 'CASH'){
            widjetController.paytypes[paysys+'_ALLOWED'] = 'Y';
        }

        if(delType) {
            widjetController.setMode(delType);
        } else {
            for(var id in deliveries){
                if(deliveryHandler.guess(id)){
                    widjetController.setMode(deliveries[id].type);
                }
            }
        }

        self.setObRequestConcat({getBasket : true,PAY_SYSTEM_ID:PAY_SYSTEM_ID,PERSON_TYPE_ID:PERSON_TYPE_ID,DELIVERY_ID:DELIVERY_ID});

        if(ready){
            init();
            preservePVZ();
        }
        initLabels();
    };

    function init(){
        if(!widjetController.active) {
            widjetController.resetPVZMarks();
            widjetController.city.set(city);
        }
    }

    function initLabels(ajaxAns){
        if(typeof (ajaxAns) == 'undefined'){
            ajaxAns = false;
        }

        labelController.find(ajaxAns);
        addressPropertyController.do();
    }

    function checkPreloader(){
        $('#'+iPE+'buttonLoader').css('display','none');
        $('#'+iPE+'subLair').css('display','block');
    }

    // subscribes
    if(typeof BX !== 'undefined' && BX.addCustomEvent)
        BX.addCustomEvent('onAjaxSuccess', self.onLoad);

    this.blockAlert = false;

    function selectPVZ(wat){
        if(wat && typeof(wat.id) !== 'undefined'){
            pvz = wat;
            if(checkPayAviable(pvz)){
                preservePVZ();
                addressPropertyController.do();
            } else {
                if(!self.blockAlert){
                    self.blockAlert = true;
                    alert(LANG.WRONG_PAY);
                    window.setTimeout(function(what){what.blockAlert = false;},100,self);
                }
                pvz = false;
            }
        } else {
            pvz = false;
        }

        if(pvz) {
            widjetController.close();
            reloadForm();
        }
    }

    function checkPayAviable(pvz)
    {
        var allow = false;
        switch(paysys){
            case 'CASH' : allow = (pvz.PVZ.IS_CASH_FORBIDDEN!=='Y'); break;
            case 'CARD' : allow = (pvz.PVZ.CARD_PAYMENT_AVAILABLE==='Y'); break;
            default     : allow = true; break;
        }
        return allow;
    }

    // deals with button "open widjet"
    var labelController = {
        // puts tag 4 labels
        find : function(ajaxAns){
            var tag = false;
            for(var i in deliveries){
                tag = false;
                if(deliveries[i].self) {
                    tag = $('#' + i);
                }else{
                    if(oldTemplate){
                        var parentNd=$('#'+deliveryHandler.makeId(i));
                        if(!parentNd.length) continue;
                        if(parentNd.closest('td', '#ORDER_FORM').length>0)
                            tag = parentNd.closest('td', '#ORDER_FORM').siblings('td:last');
                        else
                            tag = parentNd.siblings('label').find('.bx_result_price');
                    }
                    else {
                        if (
                            (typeof(ajaxAns.order) !== 'undefined' && deliveryHandler.check(i, ajaxAns.order.DELIVERY))
                            ||
                            (!ajaxAns && deliveryHandler.guess(i))
                        ) {
                            var lair = 'injectHere';
                            if (!$('#' + iPE + lair).length) {
                                $('#bx-soa-delivery').find('.bx-soa-pp-company-desc').after('<div id="' + iPE + lair + '"></div>');
                            }
                            if (!$('#' + iPE + lair).length) {
                                labelController.loader.listner();
                            } else
                                tag = $('#' + iPE + lair);
                        }
                    }
                }

                if(tag.length>0 && !tag.find('.'+iPE+'selectServices').length){
                    deliveries[i].tag = tag;
                    labelController.place(i,deliveries[i].type);
                } else {
                    deliveries[i].tag = false;
                }
            }
        },

        // adds block for opening widjet
        place: function(deliveryId,type){
            if(typeof(deliveries) === 'undefined')
                return false;

            var tmpHTML = "<div class='"+iPE+"pvzLair'>"+'<a href="javascript:void(0);" class="'+iPE+'selectPVZ">'+buttonLabel[type]+'</a>' + "<br>";
            if(pvz){
                tmpHTML += "<span class='"+iPE+"pvzAddr'>" + pvz.address + "</span><br>";
            }

            tmpHTML += "</div>";

            if(!ready){
                tmpHTML = '<img src="/bitrix/images/ipol.ozon/long_ajax.gif" id="'+iPE+'buttonLoader"><div style="display:none" id="'+iPE+'subLair">' + tmpHTML + "</div>";
            }

            deliveries[deliveryId].tag.html(tmpHTML);
            deliveries[deliveryId].tag.on('click',function(){widjetController.open();widjetController.setMode(type)});

            if(!oldTemplate) {
                $('.'+iPE+'pvzLair .'+iPE+'selectPVZ').addClass('btn btn-default btn-primary');
            }
        },

        // loader 4 new templates
        loader: {
            timer   : false,
            listner : function (){
                if(labelController.loader.timer){
                    clearTimeout(labelController.loader.timer);
                    labelController.loader.timer = false;
                    initLabels();
                }else{
                    labelController.loader.timer = setTimeout(labelController.loader.listner, 1000);
                }
            }
        }
    };

    // deals with user property for saving address there
    var addressPropertyController = {
        do    : function(){
            if(addressPropertyController.checkCorrespond()) {
                addressPropertyController.label();
                addressPropertyController.markUnable();
            }
        },
        // can be done without it - but better check so because of old template
        checkCorrespond : function(){
            for(var i in deliveries) {
                if (
                    typeof(deliveries[i]) === 'object' &&
                    typeof(deliveries[i].tag) !== false &&
                    deliveries[i].tag
                ) {
                    return true;
                }
            }

            return false;
        },

        label : function(){
            var input = addressPropertyController.getInput();
            if(input){
                if(pvz){
                    var sub = (typeof(LANG['PVZTYPE_'+pvz.PVZ.variant]) === 'undefined') ? '' : (' (' + LANG['PVZTYPE_'+pvz.PVZ.variant] + ') ');
                    input.val(pvz.PVZ.ADDRESS+sub);
                } else {
                    input.val('');
                }
            }
        },

        markUnable : function(){
            if(pvz) {
                var input = addressPropertyController.getInput();
                if (input) {
                    input.css('background-color', '#eee').attr('readonly', 'readonly');
                }
            }
        },

        getInput : function(){
            var chznPnkt = false;
            if(typeof(pvzPicker) === 'object'){
                for(var i in pvzPicker){
                    if(typeof(pvzPicker[i]) === 'string'){
                        chznPnkt = $('[name="ORDER_PROP_'+pvzPicker[i]+'"]');
                        if(chznPnkt.length){
                            break;
                        }
                    }
                }
            }

            return chznPnkt;
        }
    };

    // deals with widjet
    var widjetController = new IPOL_OZON_Widjet({
        popup: true,
        defaultCity : city,
        path        : '/bitrix/js/ipol.ozon/widjet/scripts/',
        servicepath : '/bitrix/js/ipol.ozon/ajax.php',
        apikey      : 'ad06a7e1-2f4f-42a8-88ea-72f24589c578',
        noCitySelector : true,
        noYmaps : noYmaps,
        onReady : function(){
            checkPreloader();
            ready = true;
            init();
        },
        goods : [cargo],
        onChoose : selectPVZ,
        hidecash : true,
        hidecard : true
    });

    // deals with deliveries: which is chosen
    var deliveryHandler = {
        // defining of chosen delivery
        check : function(delId,delivery){
            for(var i in delivery)
                if(delivery[i].CHECKED === 'Y'){
                    return (delivery[i].ID === delId);
                }
            return false;
        },

        guess : function(delId){
            return (deliveryHandler.makeId(delId) === $('[name="DELIVERY_ID"]:checked').attr('ID'));
        },

        makeId : function(id){
            return 'ID_DELIVERY_ID_'+id;
        }
    };

    var paysysHandler = {
        check : function(psId,paysysts){
            for(var i in paysysts)
                if(paysysts[i].CHECKED === 'Y'){
                    return (paysysts[i].ID === psId);
                }
            return false;
        },

        guess : function(psId){
            return (paysysHandler.makeId(psId) === $('[name="PAY_SYSTEM_ID"]:checked').attr('ID'));
        },

        makeId : function(id){
            return 'ID_PAY_SYSTEM_ID_'+id;
        }
    };

    // saving PVZ for future workout
    function preservePVZ(){
        var input = $('#'+savingInput);
        if(!input.length){
            var handler = false;
            if(oldTemplate){
                handler = $('#ORDER_FORM');
            } else {
                handler = $('[name="ORDER_FORM"]');
            }
            if(handler.length){
                handler.append('<input type="hidden" name="'+savingInput+'" id="'+savingInput+'" value="">');
            }
            input = $('#'+savingInput);
        }
        if(pvz){
            input.val(pvz.id);
        } else {
            input.val('');
        }
    }

    // reload form
    function reloadForm(){
        if(oldTemplate){
            if(typeof ('submitForm') !== 'undefined') {
                submitForm();
            }
        }else {
            if (typeof(BX.Sale) !== 'undefined') {
                BX.Sale.OrderAjaxComponent.sendRequest();
            }
        }
    }

    setTimeout(self.onLoad,1000);

// service
    function isEmpty(obj){
        if(typeof(obj) === 'object')
            for(var i in obj)
                return false;
        return true;
    }
    // logging
    function log(wat){
        if(true) {
            if (label)
                console.log(label+": ",wat);
            else
                console.log(wat);
        }

    }

    function error(wat){
        if (label)
            console.error(label+": ",wat);
        else
            console.error(wat);
    }

    this.log = function(wat){
        log(wat);
    };

    this.setObRequestConcat = function(obRequest){
        if(obRequest){
            widjetController.setCalcRequestConcat(obRequest);
        }
    };
}