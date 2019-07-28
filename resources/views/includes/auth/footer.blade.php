<footer class="d-flex justify-content-center">
    <div>
        <p>
            &copy; {{ Carbon\Carbon::now()->format('Y') }} <span class="font-weight-bold">{{ config('app.name') }}</span>
        </p>
    </div>
</footer>