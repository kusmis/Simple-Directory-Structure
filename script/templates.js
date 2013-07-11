<script type = "text/template" id = "ul-li">
        <ul class = "parent-r-ul">
        <li >
        <a href = "#">
        <%= link %>
        </a>
        </li>
        </ul>
</script>
<script type = "text/template" id = "ul-li-inner" >
        <ul class="inner-ul-li">
        <li>
        <a href="#">
        <%= link %>
        </a>
        </li>
        </ul>
</script>
<script type = "text/template" id = "file-input-box" >
    <div id = "head-file-box" > Enter the file name </div>
    <div id = "input-box">
    <input type = "text" id="name" value = "" />
    <input type = "button" id = "add-file" value = "Click here to add the file" />
    </div>
</script>