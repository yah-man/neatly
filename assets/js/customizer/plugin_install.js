/**
 * Install plugin
 *
 * @package Neatly
 */


jQuery( document ).ready(
    function ( $ ) {
        $.pluginInstall = {
            'init': function () {
                this.handleInstall();
                this.handleActivate();
			},

            'handleInstall': function () {
                var self = this;


                /*インストールボタンの指定*/
                jQuery( 'body' ).on( 'click', '.neatly-install-plugin.install-now', function (e) {
                    e.preventDefault();
                    var button = jQuery( this );
                    var slug = button.attr( 'data-slug' );
                    var url = button.attr( 'data-install-url' );
                    /*var redirect = jQuery( button ).attr( 'data-redirect' );*/
                    /*プラグインインストール中...*/
                    button.text( wp.updates.l10n.installing );
                    button.addClass('updating-message');
                    wp.updates.installPlugin(
                        {
                            slug: slug,
                            success: function(){
                                button.text( wp.updates.l10n.themeInstalled );

                                button.removeClass('updating-message');
                                button.addClass( 'installed updated-message button-disabled' );
                                /*self.activatePlugin(url, redirect);*/


                                setTimeout(function(){
                                  button.text( wp.updates.l10n.activatePluginLabel.replace( '%s', button.attr( 'data-name' ) ) );
                                  button.addClass( 'button activate-now' );
                                  button.removeClass('installed updated-message button-disabled install-now');
                                },3000);
							}
						}
					);
                });
            },





            'activatePlugin': function (url/*, redirect*/,button) {

                if (typeof url === 'undefined' || !url) {
                    return;
                }
                jQuery.ajax(
                    {
                        async: true,
                        type: 'GET',
                        url: url,
                        success: function () {

                            /*// Reload the page.*/
                            /*//if (typeof(redirect) !== 'undefined' && redirect !== '') {*/
                            /*//    window.location.replace(redirect);*/
                            /*//} else {*/
                            /*//    location.reload();*/
                            /*//}*/
                            //var button = jQuery( '.simple-days-install-plugin' );
                            button.addClass( 'updated-message button-disabled' );
                            button.removeClass('updating-message installed activate-now');
                            button.text(button.attr( 'data-activated' ));
                        },
                        error: function (jqXHR, exception) {
                            var msg = '';
                            if (jqXHR.status === 0) {
                                msg = 'Not connect.\n Verify Network.';
                            } else if (jqXHR.status === 404) {
                                msg = 'Requested page not found. [404]';
                            } else if (jqXHR.status === 500) {
                                msg = 'Internal Server Error [500].';
                            } else if (exception === 'parsererror') {
                                msg = 'Requested JSON parse failed.';
                            } else if (exception === 'timeout') {
                                msg = 'Time out error.';
                            } else if (exception === 'abort') {
                                msg = 'Ajax request aborted.';
                            } else {
                                msg = 'Uncaught Error.\n' + jqXHR.responseText;
                            }
                            console.log(msg);
                        },
                    }
                );
            },

            'handleActivate': function () {
                var self = this;
                //var button = jQuery( '.simple-days-install-plugin' );

                jQuery( 'body' ).on( 'click', '.activate-now', function (e) {
                    e.preventDefault();
                    var button = jQuery( this );
                    var url = button.attr( 'data-activate-url' );
                    /*var redirect = button.attr( 'data-redirect' );*/
                    button.addClass('updating-message');
                    button.removeClass('updated-message installed activate-now');
                    button.text(button.attr( 'data-activating' ));
                    self.activatePlugin(url/*,redirect*/,button);

                });
            },

        };
        $.pluginInstall.init();
	}
);