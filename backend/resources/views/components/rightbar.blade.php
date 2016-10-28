<aside class="control-sidebar control-sidebar-dark chat-open-right">

 <div>
            <!-- Home tab content -->
            <div class="tab-pane chat-panel" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading no-margin">Chat</h3>

                <div class="form-group">
                    <input id="searchinput" class="form-control search" type="search" placeholder="Search..."/>
                </div>
                <ul class="control-sidebar-menu" id="friend-chat-list">
                    <li class="text-center"><br>
                    <img src="{{ URL::asset('images/ajax-loader.gif') }}"/>
                    </li>
                </ul><!-- /.control-sidebar-menu --> 

            </div><!-- /.tab-pane -->
        </div>

</aside>  

    <!-- Chat boxes -->
    <div class="chat-boxes" id="chat-boxes">
    </div>
<script type="text/javascript">

function chatInit() {
    $('#searchinput').on('input', function(event) {
                 // Declare variables
                        var input, filter, ul, li, a, i;
                        input = document.getElementById('searchinput');
                        filter = input.value.toUpperCase();
                        ul =  $("#friend-chat-list");
                        li = $( "#friend-chat-list li" );

                    // Loop through all list items, and hide those who don't match the search query
                        for (i = 0; i < li.length; i++) {
                            a = li[i]['innerText'];
                            if (a.toUpperCase().indexOf(filter) > -1) {
                                //console.log(a.innerHTML.toUpperCase().indexOf(filter));
                                li[i].style.display = "";
                            } else {
                                li[i].style.display = "none";
                            }
                        }
                });
}

$(chatInit);
</script>
