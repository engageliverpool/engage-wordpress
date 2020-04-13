jQuery(function($){
    $('[data-google-map-coordinates]').each(function(){
        if ( typeof google !== 'object' || typeof google.maps !== 'object' ) {
            return;
        }

        var $container = $(this);
        var coordinates = $container.data('google-map-coordinates').split(',');
        var location = {
            lat: parseFloat(coordinates[0]),
            lng: parseFloat(coordinates[1])
        };
        var map = new google.maps.Map(
            $container[0],
            {
                zoom: 15,
                center: location
            }
        );

        new google.maps.Marker({
            position: location,
            map: map
        });
    });
});
