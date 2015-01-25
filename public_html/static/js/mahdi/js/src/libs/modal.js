(function(e, t) {
    var n = e.document;
    n.onreadystatechange = function() {
        if (document.readyState !== "complete") return;
        n.body.addEventListener("click", function(t) {
            var e = document.querySelectorAll("[data-modal]");
            var n = !1,
                r = t.target;
            r.getAttribute("data-modal") !== null && (n = !0);
            while (!n && r.parentNode && r.parentNode.tagName) r = r.parentNode, r.getAttribute("data-modal") !== null && (n = !0);
            for (var i = 0, s = e.length; i < s; i++) {
                if (n && e[i] == r) return;
                var o = new CustomEvent("close");
                e[i].dispatchEvent(o)
            }
        })
    }
    $('[data-modal]').on('close', function() {
      $(this).hide();
    })
})(this);