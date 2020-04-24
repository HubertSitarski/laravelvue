<template>
    <div class="messages-wrapper" role="alert">
        <transition-group name="list" mode="in-out" tag="article">
            <article
                    v-for="(notification, id) in notifications"
                    v-bind:key="`message-${id}`"
                    :class="`alert alert-${notification.type}`"
                    @click="removeNotification(notification)"
            >
                <div class="message-header">
                    <strong>{{ notification.title }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="message-body">
                    {{ notification.content }}
                </div>
            </article>
        </transition-group>
    </div>
</template>

<script>
    export default {
        computed: {
            notifications() {
                return this.$store.getters.getNotifications
            }
        },
        methods: {
            removeNotification(notification) {
                this.$store.dispatch('removeNotification', notification)
            }
        }
    }
</script>
