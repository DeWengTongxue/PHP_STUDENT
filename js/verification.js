/* 验证手机号码 */
function myPhone(val) {
    var myreg = /^(((13[0-9]{1})|(14[0-9]{1})|(15[0-9]{1})|(16[0-9]{1})|(17[0-9]{1})|(18[0-9]{1})|(19[0-9]{1}))+\d{8})$/;
    if (!myreg.test(val)) {
        return false;
    }
    return true;
}
/* 验证是否是number类型 */
function myIsNaN(value) {
    var val = parseInt(value);
    return typeof val === 'number' && !isNaN(val);
}
/* 获取单选框选定的值 */
function getRadioVal(nameVal) {
    var inputs = document.getElementsByName(nameVal);
    var checkVal = "";
    for (var i = 0, len = inputs.length; i < len; i++) {
        if (inputs[i].checked) {
            checkVal = inputs[i].value;
        }
    }
    return checkVal;
}