<template>
    <div class="Geo">
        {{location}}
    </div>
</template>

<script>
    export default {
        props: {
        },
        computed:{
            location(){
                this.$getLocation({
                    enableHighAccuracy: true, //defaults to false
                    timeout: Infinity, //defaults to Infinity
                    maximumAge: 1 //defaults to 0

                })
                    .then(coordinates => {
                        console.log(coordinates);
                    });
            }
        }
    };
</script>
