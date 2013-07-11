var ClickedBy;
var SelfRef;
var ReqStatus;
var InsertId;
(function($) {
    $(document).ready(function() {
        var FileStructure = Backbone.View.extend({
            el: "body",
            initialize: function() {
                var template = _.template($("#file-input-box").html(), {});
                $("#fly-box").html(template);
                $("#fly-box").css('position','absolute');
                $("#fly-box").css('margin-left', ($(window).width() - $("#fly-box").width()) / 2);
                $("#fly-box").css('margin-top', ($(window).height() - $("#fly-box").height()) / 2);
            },
            events: {
                "click #add_new_file": "openFlyBox",
                "click #add-file": "closeFlyBox",
                "click .parent-r-ul": "openFlyBox",
                "keypress": "checkKey",
                "touchmove": "touched"
            },
            openFlyBox: function(event) {
                window.ClickedBy = $(event.target);
                window.SelfRef = window.ClickedBy.attr('selfref');
                $("#fly-box").show();
                $("#fly-box").attr('class', 'animated bounceInLeft');
                $("#name").focus();
            },
            closeFlyBox: function(event) {
                this.saveFolder();
                var int = setInterval(function() {
                    if(typeof window.ReqStatus != undefined) {
                        clearInterval(int);
                        if ($("#name").val() != "") {
                            $("#fly-box").attr('class', '');
                            var name = $("#name").val();
                            if (window.ClickedBy.attr('class') == "add_new_file") {
                                var template = _.template($("#ul-li").html(), {link: name, selfref: window.InsertId});
                                $("#directory_structure").append(template);
                            }
                            else {
                                var template = _.template($("#ul-li-inner").html(), {link: name, selfref: window.InsertId});
                                window.ClickedBy.append(template);
                            }
                            $("#fly-box").attr('class', 'animated bounceOutRight');
                            setTimeout(function() {
                                $("#fly-box").hide();
                            }, 1000);
                        }
                    }
                },500);
                
            },
            checkKey: function(event) {
                var keynum = event.which;
                if (keynum == 13) {
                    $("#add-file").trigger("click");
                }
                else if (keynum == 0) {
                    if ($("#fly-box").css('display') != 'none') {
                        $("#fly-box").attr('class', '');
                        $("#fly-box").attr('class', 'animated bounceOutRight');
                        setTimeout(function() {
                            $("#fly-box").hide();
                        }, 1000);
                    }
                }
            },
            saveFolder: function( event ) {
                if(window.ClickedBy.attr('id') == 'add_new_file') {
                    var send_data = "0";
                }
                else {
                    var send_data = window.SelfRef;
                }
                var folName = $("#name").val();
                var id;
                $.ajax({
                    url: "filesDb/filesDb.php",
                    type: "POST",
                    data: { id: send_data, name: folName },
                    success: function( response ) {
                        window.ReqStatus = "true";
                        window.InsertId = response;                        
                    }
                });
            },
            touched: function( event ) {
                alert('ji');
            }
        });
        new FileStructure();
    });

})(jQuery);