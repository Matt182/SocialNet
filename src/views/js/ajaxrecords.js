function ajaxrecord(id)
{
    var xhr = new XMLHttpRequest();

    var body = 'content=' +  encodeURIComponent(document.getElementsByTagName('textarea').value);

    xhr.open('POST','/hive2/profile/'+ id +'/postRecord', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xhr.onreadystatechange=function()
    {
        if (xhr.readyState==4 && xhr.status==200) {
            document.getElementById("records").innerHTML = xhr.responseText;
        }
    }
    xhr.send(body);

}
