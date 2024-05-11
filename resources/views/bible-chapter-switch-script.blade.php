<script>
    let bibleReadyUrl = {{ \Illuminate\Support\Js::from(route('bolls-life-bible-ready')) }};
    let bibleReadyBook = "John";
    let bibleReadyChapter = 1;

    let url = bibleReadyUrl;

    function updateReadyBook(el) {
        bibleReadyBook = el.value;

        updateBibleReadyUrl();
    }

    function updateReadyChapter(el) {
        bibleReadyChapter = el.value;

        updateBibleReadyUrl();
    }

    function updateBibleReadyUrl() {
        url = bibleReadyUrl + "?book="+ bibleReadyBook + "&chapter=" + bibleReadyChapter;
        console.log({url})
        document.getElementById("bible-ready-open-btn")
            .href = url;
    }
</script>
