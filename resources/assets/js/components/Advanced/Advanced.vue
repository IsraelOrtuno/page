<template>
    <div class="seo-advanced">
        <div class="row">
            <div class="col-md-4">
                <label>Meta robots index</label>

                <div class="mb-2 d-flex align-items-center">
                    <input id="robot-noindex" type="checkbox" class="robot-noindex tgl tgl-flat"
                           value="true" :checked="robots.noindex" @change="setRobots({key: 'noindex', value: $event.target.checked})">
                    <label for="robot-noindex" class="tgl-btn mb-0 mr-2"></label>
                    <div>No index</div>
                    <input type="hidden" name="seo[meta][robots][noindex]" :value="robots.noindex">
                </div>
            </div>

            <div class="col-md-4">
                <label>Meta robots follow</label>

                <div class="mb-2 d-flex align-items-center">
                    <input id="robot-nofollow" type="checkbox" class="robot-nofollow tgl tgl-flat"
                           value="true" :checked="robots.nofollow" @change="setRobots({key: 'nofollow', value: $event.target.checked})">
                    <label for="robot-nofollow" class="tgl-btn mb-0 mr-2"></label>
                    <div>No follow</div>
                    <input type="hidden" name="seo[meta][robots][nofollow]" :value="robots.nofollow">
                </div>
            </div>

            <div class="col-md-4">
                <label>Advanced robots</label>

                <div class="mb-2 d-flex align-items-center">
                    <input id="robot-noimageindex" type="checkbox" class="robot-noimageindex tgl tgl-flat"
                           value="true" :checked="robots.noimageindex"
                           @change="setRobots({key: 'noimageindex', value: $event.target.checked})">
                    <label for="robot-noimageindex" class="tgl-btn mb-0 mr-2"></label>
                    <div>No image index</div>
                    <input type="hidden" name="seo[meta][robots][noimageindex]" :value="robots.noimageindex">
                </div>
                <div class="mb-2 d-flex align-items-center">
                    <input id="robot-noarchive" type="checkbox" class="robot-noarchive tgl tgl-flat"
                           value="true" :checked="robots.noarchive" @change="setRobots({key: 'noarchive', value: $event.target.checked})">
                    <label for="robot-noarchive" class="tgl-btn mb-0 mr-2"></label>
                    <div>No archive</div>
                    <input type="hidden" name="seo[meta][robots][noarchive]" :value="robots.noarchive">
                </div>
                <div class="mb-2 d-flex align-items-center">
                    <input id="robot-nosnippet" type="checkbox" class="robot-nosnippet tgl tgl-flat"
                           value="true" :checked="robots.nosnippet" @change="setRobots({key: 'nosnippet', value: $event.target.checked})">
                    <label for="robot-nosnippet" class="tgl-btn mb-0 mr-2"></label>
                    <div>No snippet</div>
                    <input type="hidden" name="seo[meta][robots][nosnippet]" :value="robots.nosnippet">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Canonical</label>
            <input type="text" name="seo[meta][canonical]" class="form-control" v-model="canonical">
        </div>
    </div>
</template>

<script>
    import store from '../../store'

    export default {
        data() {
            return {
                sharedState: store.state
            }
        },

        computed: {
            robots() {
                return this.sharedState.meta.robots
            },
            canonical: {
                get() {
                    return this.sharedState.meta.canonical
                },
                set(value) {
                    console.log(value)
                    this.sharedState.meta.canonical = value
                }
            }
        },
        methods: {
            setRobots({key, value}) {
                // this.$set(this.sharedState.meta.robots, key, value)
            }
        }
    }
</script>

<style lang="scss">
    .tg-list {
        text-align  : center;
        display     : flex;
        align-items : center;
    }

    .tg-list-item {
        margin : 0 2em;
    }

    .tgl {
        display : none;

        & + .tgl-btn {
            box-sizing : border-box;
            &::selection {
                background : none;
            }
        }

        + .tgl-btn {
            outline     : 0;
            display     : block;
            width       : 4em;
            height      : 2em;
            position    : relative;
            cursor      : pointer;
            user-select : none;
            &:after,
            &:before {
                position : relative;
                display  : block;
                content  : "";
                width    : 50%;
                height   : 100%;
            }

            &:after {
                left : 0;
            }

            &:before {
                display : none;
            }
        }

        &:checked + .tgl-btn:after {
            left : 50%;
        }
    }

    // themes
    .tgl-light {
        + .tgl-btn {
            background    : #f0f0f0;
            border-radius : 2em;
            padding       : 2px;
            transition    : all .4s ease;
            &:after {
                border-radius : 50%;
                background    : #fff;
                transition    : all .2s ease;
            }
        }

        &:checked + .tgl-btn {
            background : #9fd6ae;
        }
    }

    .tgl-flat {
        + .tgl-btn {
            padding       : 2px;
            transition    : all .2s ease;
            background    : #fff;
            border        : 4px solid #f2f2f2;
            border-radius : 2em;
            &:after {
                transition    : all .2s ease;
                background    : #f2f2f2;
                content       : "";
                border-radius : 1em;
            }
        }

        &:checked + .tgl-btn {
            border : 4px solid #7fc6a6;
            &:after {
                left       : 50%;
                background : #7fc6a6;
            }
        }
    }

    .tgl-flip {
        + .tgl-btn {
            padding     : 2px;
            transition  : all .2s ease;
            font-family : sans-serif;
            perspective : 100px;
            &:after,
            &:before {
                display             : inline-block;
                transition          : all .4s ease;
                width               : 100%;
                text-align          : center;
                position            : absolute;
                line-height         : 2em;
                font-weight         : bold;
                color               : #fff;
                position            : absolute;
                top                 : 0;
                left                : 0;
                backface-visibility : hidden;
                border-radius       : 4px;
            }

            &:after {
                content    : attr(data-tg-on);
                background : #02c66f;
                transform  : rotateY(-180deg);
            }

            &:before {
                background : #7fc6a6;
                content    : attr(data-tg-off);
            }

            &:active:before {
                transform : rotateY(-20deg);
            }
        }

        &:checked + .tgl-btn {
            &:before {
                transform : rotateY(180deg);
            }

            &:after {
                transform  : rotateY(0);
                left       : 0;
                background : #ff3a19;
            }

            &:active:after {
                transform : rotateY(20deg);
            }
        }
    }
</style>