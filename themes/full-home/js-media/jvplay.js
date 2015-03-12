(function ($) {
    $.fn.extend({
        autoPlayVideo: function (options) {
            var defaults = {
                source: ['demo'],
                index: 0,
                wrapperClass: 'myvideo',
                /* callback fnc */
                before: function (t) {
                },
                after: function (t) {
                }
            };

            options = $.extend({}, defaults, options);  /* callback fnc */

            var o = $.extend(defaults, options);

            this.each(function () {

                var me = $(this);

                setup(o.source, me);

                me[0].addEventListener('ended', function (e) {
                    setup(o.source, me);
                    if (options.after) {
                        options.after(o);
                    }
                });

            });

            function setup(s, v) {

                var count = s.length;
                if (o.index > 0 && o.index < count) {
                } else {
                    o.index = 0;
                }

                s = s[o.index];

                // Get all of the uri's we support
                var indexOfExtension = s.lastIndexOf(".");
                var extension = s.substr(indexOfExtension, s.length - indexOfExtension);

                var ogguri = encodeURI(s.replace(extension, ".ogv"));
                var webmuri = encodeURI(s.replace(extension, ".webm"));
                var mp4uri = encodeURI(s.replace(extension, ".mp4"));

                // Test for support
                if (v[0].canPlayType("video/ogg")) {
                    v[0].setAttribute("src", ogguri);
                }
                else if (v.canPlayType("video/webm")) {
                    v[0].setAttribute("src", webmuri);
                }
                else if (v.canPlayType("video/mp4")) {
                    v[0].setAttribute("src", mp4uri);
                }

                o.index++;
            }

        }
    });

    $.fn.extend({
        autoPlayVideo: $.fn.autoPlayVideo
    });

})(jQuery);