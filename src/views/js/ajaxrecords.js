function ajaxrecord(id)
{
    var xhr = new XMLHttpRequest();
    var formData = new FormData(document.forms.postRecord);

    xhr.open('POST','/profile/'+ id +'/postRecord', true);
    xhr.onreadystatechange=function()
    {
        if (xhr.readyState==4 && xhr.status==200) {
            document.getElementById("records").innerHTML = xhr.responseText;
        }
    }
    xhr.send(formData);

}
