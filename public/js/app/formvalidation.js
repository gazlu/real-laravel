function resetTextBox(frmVal) {
    for (var i = 0; i < document.forms[frmVal].elements.length; i++) {
        if (document.forms[frmVal].elements[i].type == "text") {
            if (document.forms[frmVal].elements[i].value != "") {
                document.forms[frmVal].elements[i].style.border = "#339900 1px solid";
            }
        }
    }
}

function stringTrim(stringToTrim) {
    return stringToTrim.replace(/^\s+|\s+$/g, "");
}

function subCommonForm(frmVal, valsection) {
    var setBool = "1";
    var fTEle = null;
    var fSEle = null;
    var arVal = null;
    var errMsg = null;
    $('#genMsg').fadeOut();

    for (var i = 0; i < document.forms[frmVal].elements.length; i++) {
        if ((document.forms[frmVal].elements[i].getAttribute("req") == "true" || document.forms[frmVal].elements[i].getAttribute("req") == "valid") && !document.forms[frmVal].elements[i].disabled && document.forms[frmVal].elements[i].getAttribute("valsection") == valsection) {
            if (document.forms[frmVal].elements[i].type == "text" || document.forms[frmVal].elements[i].type == "password" || document.forms[frmVal].elements[i].type == "number") {
                var cntValue = new String(document.forms[frmVal].elements[i].value);
                document.forms[frmVal].elements[i].value = stringTrim(cntValue);
                if (stringTrim(cntValue) != "") {
                    document.forms[frmVal].elements[i].style.border = "#339900 1px solid";
                } else {                    
                    if (document.forms[frmVal].elements[i].type == "text" && document.forms[frmVal].elements[i].value == ".") {
                    }
                    else {
                        document.forms[frmVal].elements[i].style.border = "red 1px solid";
                        if (fTEle == null) {
                            fTEle = i;
                            errMsg = document.forms[frmVal].elements[i].getAttribute("errmsg");
                            errMsg = $('#' + document.forms[frmVal].elements[i].id).attr("placeholder");
                        }
                        setBool = "0";
                    }
                }//
            }
            if (document.forms[frmVal].elements[i].type == "date") {
                var cntValue = new String(document.forms[frmVal].elements[i].value);
                document.forms[frmVal].elements[i].value = stringTrim(cntValue);
                if (stringTrim(cntValue) != "" || cntValue.indexOf('mm') >= 0) {
                    document.forms[frmVal].elements[i].style.border = "#339900 1px solid";
                } else {
                    document.forms[frmVal].elements[i].style.border = "red 1px solid";
                    if (fTEle == null) {
                        fTEle = i;
                        errMsg = document.forms[frmVal].elements[i].getAttribute("errmsg");
                        errMsg = $('#' + document.forms[frmVal].elements[i].id).attr("placeholder");
                    }
                    setBool = "0";
                }
            }
            if (document.forms[frmVal].elements[i].type == "hidden") {
                if (document.forms[frmVal].elements[i].value != "") {
                    document.forms[frmVal].elements[i].style.border = "#339900 1px solid";
                } else {
                    document.forms[frmVal].elements[i].style.border = "red 1px solid";
                    if (fTEle == null) {
                        fTEle = i;
                        errMsg = document.forms[frmVal].elements[i].getAttribute("errmsg");
                    }
                    setBool = "0";
                }
            } else if (document.forms[frmVal].elements[i].type == "select-one") {
                var selOptValue = new String(document.forms[frmVal].elements[i].value);
                //alert(selOptValue.length);
                if (selOptValue != '0' && selOptValue.length != 0) {
                    document.forms[frmVal].elements[i].style.border = "#339900 1px solid";
                } else {
                    document.forms[frmVal].elements[i].style.border = "red 1px solid";
                    if (fTEle == null) {
                        fTEle = i;
                        errMsg = document.forms[frmVal].elements[i].getAttribute("errmsg");
                        errMsg = $('#' + document.forms[frmVal].elements[i].id).attr("placeholder");
                    }
                    setBool = "0";
                }
            } else if (document.forms[frmVal].elements[i].type == "select-multiple") {
                var isMulti = document.forms[frmVal].elements[i].getAttribute("multiple");

                //alert(document.forms[frmVal].elements[i].length);

                if (isMulti) {
                    if (document.forms[frmVal].elements[i].length > 0) {
                        document.forms[frmVal].elements[i].style.border = "#339900 1px solid";
                    } else {
                        document.forms[frmVal].elements[i].style.border = "red 1px solid";
                        if (fTEle == null) {
                            fTEle = i;
                            errMsg = document.forms[frmVal].elements[i].getAttribute("errmsg");
                        }
                        setBool = "0";
                    }
                }
            } else if (document.forms[frmVal].elements[i].type == "hidden") {
                if (document.forms[frmVal].elements[i].value != "") {
                    document.forms[frmVal].elements[i].style.border = "#339900 1px solid";
                } else {
                    document.forms[frmVal].elements[i].style.border = "red 1px solid";
                    if (fTEle == null) {
                        fTEle = i;
                        errMsg = document.forms[frmVal].elements[i].getAttribute("errmsg");
                    }
                    setBool = "0";
                }
            } else if (document.forms[frmVal].elements[i].type == "textarea") {
                if (document.forms[frmVal].elements[i].value != "") {
                    document.forms[frmVal].elements[i].style.border = "#339900 1px solid";
                } else {
                    document.forms[frmVal].elements[i].style.border = "red 1px solid";
                    if (fTEle == null) {
                        fTEle = i;
                        errMsg = document.forms[frmVal].elements[i].getAttribute("errmsg");
                        errMsg = $('#' + document.forms[frmVal].elements[i].id).attr("placeholder");
                    }
                    setBool = "0";
                }
            } else if (document.forms[frmVal].elements[i].type == "radio") {
                //alert(document.forms[frmVal].elements[i].value);
                if (document.forms[frmVal].elements[i].value != "") {
                    document.forms[frmVal].elements[i].style.border = "#339900 1px solid";
                } else {
                    document.forms[frmVal].elements[i].style.border = "red 1px solid";
                    if (fTEle == null) {
                        fTEle = i;
                    }
                    setBool = "0";
                }
            }
        }
    }
    if (setBool == "0") {
        if (fTEle != null) {
            if (document.forms[frmVal].elements[fTEle].type != "hidden") {
                document.forms[frmVal].elements[fTEle].focus();
            }
            if (errMsg == null || errMsg == '') {
                document.getElementById("genMsg").innerHTML = "Please fill all required Fields.";
                $('#genMsg').fadeIn('slow');
            } else {
                document.getElementById("genMsg").innerHTML = errMsg;
                $('#genMsg').fadeIn('slow');
                errMsg = '';
            }
            return false;
        }

        if (AllValidData(frmVal)) {
            return true;
        } else {
            return false;
        }
    } else {
        if (AllValidData(frmVal)) {
            return true;
        } else {
            return false;
        }
    }
}

function AllValidData(frmVal) {
    var strError = "";
    document.getElementById("genMsg").innerHTML = "&nbsp;";
    for (var i = 0; i < document.forms[frmVal].elements.length; i++) {
        var swCase = document.forms[frmVal].elements[i].getAttribute("valdata");
        var iEle = document.forms[frmVal].elements[i];
        /*
		if(swCase==null && document.forms[frmVal].elements[i].getAttribute("Validators")!=null){
			swCase = "date";
		}
		alert($(document.forms[frmVal].elements[i]).attr('name')+'\n'+$(document.forms[frmVal].elements[i]).attr('valdata'));
		*/
        if (swCase != null && !iEle.disabled && iEle != null) {
            switch (swCase) {
                case "alnum":
                case "alphanumeric": {
                    var charpos = iEle.value.search("[^A-Za-z0-9 ]");
                    if (iEle.value.length > 0 && charpos >= 0) {
                        if (!strError || strError.length == 0) {
                            strError = " Only alpha-numeric characters allowed ";
                        }//if 
                        document.getElementById("genMsg").innerHTML = strError;// + " " + eval(charpos+1)+"]"; 
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }
                    break;
                }//case alphanumeric 
                case "num":
                case "int":
                case "numeric": {
                    var charpos = iEle.value.search("[^0-9]");
                    if (iEle.value.length > 0 && charpos >= 0) {

                        if (!strError || strError.length == 0) {
                            strError = " Only digits allowed ";
                        }//if               
                        document.getElementById("genMsg").innerHTML = strError;
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }//if 
                    break;
                }//numeric 
                case "decimal": {
                    var charpos = iEle.value.search("[^0-9 .]");
                    if (isNaN(iEle.value)) {
                        if (!strError || strError.length == 0) {
                            strError = " Only float values allowed ";
                        }//if

                        document.getElementById("genMsg").innerHTML = strError;// + "" + eval(charpos+1)+"]"; 
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }

                    if (iEle.value.length > 0 && charpos >= 0) {
                        if (!strError || strError.length == 0) {
                            strError = " Only float values allowed ";
                        }//if               
                        document.getElementById("genMsg").innerHTML = strError;// + "" + eval(charpos+1)+"]"; 
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }//if 
                    break;
                }//Float
                case "per":
                case "percent": {
                    var charpos = iEle.value.search("[^0-9 .]");
                    if (isNaN(iEle.value)) {
                        if (!strError || strError.length == 0) {
                            strError = " Only digits allowed ";
                        }//if

                        document.getElementById("genMsg").innerHTML = strError;// + "" + eval(charpos+1)+"]"; 
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }

                    if (iEle.value.length > 0 && charpos >= 0) {
                        if (!strError || strError.length == 0) {
                            strError = " Only digits allowed ";
                        }//if

                        document.getElementById("genMsg").innerHTML = strError;// + "" + eval(charpos+1)+"]"; 
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }//if

                    if (parseInt(iEle.value) > 100) {
                        strError = "Percentage value can not exceed 100";

                        document.getElementById("genMsg").innerHTML = strError;
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }
                    break;
                }//Percentage
                case "alphabetic":
                case "alpha": {
                    var controlValue = new String(iEle.value);
                    var charpos = iEle.value.search("[^A-Za-z\ ]");
                    if (iEle.value.length > 0 && charpos >= 0) {
                        if (!strError || strError.length == 0) {
                            strError = " Only alphabetic characters allowed ";
                        }//if

                        document.getElementById("genMsg").innerHTML = strError;// + "" + eval(charpos+1)+"]"; 
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }//if

                    if (controlValue.charAt(0) == ' ') {
                        if (!strError || strError.length == 0) {
                            strError = "Leading spaces are not allowed.";
                        }//if

                        document.getElementById("genMsg").innerHTML = strError;// + "" + eval(charpos+1)+"]"; 
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }//if
                    break;
                }//alpha 
                case "alnumhyphen": {
                    var charpos = iEle.value.search("[^A-Za-z0-9\-_\]");
                    if (iEle.value.length > 0 && charpos >= 0) {
                        if (!strError || strError.length == 0) {
                            strError = " characters allowed are A-Z,a-z,0-9,- and _";
                        }//if                             
                        document.getElementById("genMsg").innerHTML = strError;// + " " + eval(charpos+1)+"]"; 
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }//if
                    break;
                }
                case "email": {
                    if (!validateEmailv2(iEle.value)) {
                        if (!strError || strError.length == 0) {
                            strError = " Enter a valid Email address ";
                        }//if                                               
                        document.getElementById("genMsg").innerHTML = strError;
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }//if
                    break;
                }//case email 
                case "lt":
                case "lessthan": {
                    if (isNaN(iEle.value)) {
                        document.getElementById("genMsg").innerHTML = " Should be a number ";
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }//if 
                    if (eval(iEle.value) >= eval(cmdvalue)) {
                        if (!strError || strError.length == 0) {
                            strError = "  value should be less than " + cmdvalue;
                        }//if               
                        document.getElementById("genMsg").innerHTML = strError;
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }//if
                    break;
                }//case lessthan 
                case "gt":
                case "greaterthan": {
                    if (isNaN(iEle.value)) {
                        document.getElementById("genMsg").innerHTML = " Should be a number ";
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }//if 
                    if (eval(iEle.value) <= eval(cmdvalue)) {
                        if (!strError || strError.length == 0) {
                            strError = " value should be greater than " + cmdvalue;
                        }//if               
                        document.getElementById("genMsg").innerHTML = strError;
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }//if
                    break;
                }//case greaterthan 
                case "regexp": {
                    if (iEle.value.length > 0) {
                        if (!iEle.value.match(cmdvalue)) {
                            if (!strError || strError.length == 0) {
                                strError = " Invalid characters found ";
                            }//if                                                               
                            document.getElementById("genMsg").innerHTML = strError;
                            iEle.style.border = "red 1px solid";
                            $('#genMsg').fadeIn();
                            iEle.focus();
                            return false;
                        }//if 
                    }
                    break;
                }//case regexp 
                case "dontselect": {
                    if (iEle.selectedIndex == null) {
                        document.getElementById("genMsg").innerHTML = "BUG: dontselect command for non-select Item";
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }
                    if (iEle.selectedIndex == eval(cmdvalue)) {
                        if (!strError || strError.length == 0) {
                            strError = " Please Select one option ";
                        }//if                                
                        document.getElementById("genMsg").innerHTML = strError;
                        iEle.style.border = "red 1px solid";
                        $('#genMsg').fadeIn();
                        iEle.focus();
                        return false;
                    }
                    break;
                }//case Date
                case "DateTime": {
                    if (iEle.value.length < 8) {
                        iEle.style.border = "red 1px solid";
                        strError = " Invalid Date.";
                        document.getElementById("genMsg").innerHTML = strError;
                        iEle.focus();
                        return false;
                    } else {
                        if (iEle.value.indexOf('/') < 0) {
                            iEle.style.border = "red 1px solid";
                            strError = " Invalid Date.";
                            document.getElementById("genMsg").innerHTML = strError;
                            $('#genMsg').fadeIn();
                            iEle.focus();
                            return false;
                        } else {
                            if (iEle.value.indexOf('/') < 0) {
                                strError = " Invalid Date.";
                                iEle.style.border = "red 1px solid";
                                document.getElementById("genMsg").innerHTML = strError;
                                $('#genMsg').fadeIn();
                                iEle.focus();
                                return false;
                            }
                        }
                    }
                    break;
                }//case Date 
            }//switch 			
        }
    }
    return true;
}

function validateEmailv2(email) {
    if (email.length <= 0) {
        return true;
    }

    var splitted = email.match("^(.+)@(.+)$");
    if (splitted == null) return false;

    if (splitted[1] != null) {
        var regexp_user = /^\"?[\w-_\.]*\"?$/;
        if (splitted[1].match(regexp_user) == null) return false;
    }

    if (splitted[2] != null) {
        var regexp_domain = /^[\w-\.]*\.[A-Za-z]{2,4}$/;
        if (splitted[2].match(regexp_domain) == null) {
            var regexp_ip = /^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
            if (splitted[2].match(regexp_ip) == null) return false;
        }// if
        return true;
    }
    return false;
}

function validateDate(txtDate, errmsg) {
    re = /^\d{1,2}\/\d{1,2}\/\d{4}$/;

    document.getElementById("genMsg").innerHTML = '';
    if (txtDate.value != '' && !txtDate.value.match(re)) {
        document.getElementById("genMsg").innerHTML = errmsg;
        txtDate.value = '';
        txtDate.focus();
        return false;
    }

    return true;
}

function refreshParent() {
    window.parent.location.href = window.parent.location.href;
}