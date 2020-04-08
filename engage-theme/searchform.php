<?php $id = 's_' . uniqid(); ?>
<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
    <label for="<?php echo esc_attr($id); ?>" class="search-form__label">
        Search news, projects, and events
    </label>
    <div class="search-form__inputs">
        <input type="search" class="form-control" value="<?php the_search_query(); ?>" name="s" id="<?php echo esc_attr($id); ?>">
        <button type="submit" class="btn btn-primary" title="Search">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="#fff" d="M9.9 0A10 10 0 0 0 0 9.9a10 10 0 0 0 15.6 8.2l5.4 5.4a2 2 0 0 0 2.5 0 2 2 0 0 0 0-2.5L18 15.6A9.9 9.9 0 0 0 10 0H10zm0 3.4c3.6 0 6.5 3 6.5 6.5a6.4 6.4 0 0 1-6.5 6.6 6.5 6.5 0 0 1 0-13z"/></svg>
        </button>
    </div>
</form>
