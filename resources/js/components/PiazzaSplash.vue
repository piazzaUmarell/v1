<template>
    <div class="w-screen h-screen bg-blue flex flex-col justify-center align-center text-center">
        <div class="text-white leading-tight">
            <h1 class="text-5xl font-semibold">
                <slot name="title"></slot>
            </h1>
            <h2 class="text-2xl font-normal">
                <slot name="description"></slot>
            </h2>
            <p class="text-lg font-light leading-loose">
                <slot name="caption"></slot>
            </p>
        </div>
        <div>
            <font-awesome-icon
                icon="chevron-down"
                class="text-5xl text-white animated bounceInDown my-4 absolute pin-b z-0 cursor-pointer"
                @click="scroll"
                v-show="false"
            />
        </div>
    </div>
</template>

<script>
    import { library } from '@fortawesome/fontawesome-svg-core';
    import { faChevronDown } from '@fortawesome/free-solid-svg-icons';

    export default {
        props: [
            'scroll-to'
        ],

        created() {
            library.add(faChevronDown);
        },

        methods: {
            scroll() {
                this.$scrollTo(
                    this.scrollTo,
                    500,
                    {
                        container: 'body',
                        easing: 'ease-in',
                        offset: "200px",
                        cancelable: true,
                        x: false,
                        y: true
                    }
                );
            }
        }
    }
</script>