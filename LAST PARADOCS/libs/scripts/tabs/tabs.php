<script>
	function openTab(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script> <!--Скрипт вкладок -->
<script>
	function openTabs(evt, cityNames) {
    // Declare all variables
    var is, tabcontents, tablinkss;

    // Get all elements with class="tabcontent" and hide them
    tabcontents = document.getElementsByClassName("tabcontents");
    for (is = 0; is < tabcontents.length; is++) {
        tabcontents[is].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinkss = document.getElementsByClassName("tablinkss");
    for (is = 0; is < tablinkss.length; is++) {
        tablinkss[is].className = tablinkss[is].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityNames).style.display = "block";
    evt.currentTarget.className += " active";
}
</script> <!--Скрипт вкладок -->