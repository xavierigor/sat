<footer class="d-flex justify-content-center">
    <div>
        <p>
            &copy; {{ Carbon\Carbon::now()->format('Y') }} <span>{{ config('app.name') }}</span>
        </p>
    </div>
</footer>