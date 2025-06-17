<form method="GET" action="/search">
    <div class="input-group">
        <i class="bi bi-search"></i>
        <input type="text" name="query"class="form-control border-0 border-5 rounded-0 py-0 shadow-none"
            id="search" value="{{ isset($query) ? $query : '' }}" placeholder="Search">
    </div>
</form>

<hr class="mt-1 border-3">
<div id="tooltips" class="mt-5 text-muted" style="display: none;"> <span class="h5 text-dark"> Available filters
    </span>
    <hr class="my-1">
    Filter users using&nbsp;<span class="text-reset fw-bold"> user: </span> <br>
    Filter courses using&nbsp;<span class="text-reset fw-bold"> course: </span> <br>
    Separate queries with&nbsp;pipe&nbsp;<span class="text-reset fw-bold"> | </span>
    <hr>
</div>

<script>
    const searchElement = document.getElementById('search');
    const tooltipsElement = document.getElementById('tooltips');
    const prevPlaceholder = searchElement.placeholder;

    searchElement.addEventListener('focus', function() {
        this.placeholder = '';
        tooltipsElement.style.display = "block";
    });

    searchElement.addEventListener('blur', function() {
        this.placeholder = prevPlaceholder;
        tooltipsElement.style.display = "none";
    });
</script>
