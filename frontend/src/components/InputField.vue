<template>
    <div>
        <label
                class="label"
                v-if="label"
        >{{ label }}</label>
        <div class="control has-icons-right">
            <input
                    :type="type"
                    class="input form-control"
                    v-bind:value="value"
                    v-on:input="$emit('input', $event.target.value)"
                    required
            >
            <!--            <span-->
            <!--                class="icon is-right has-text-danger"-->
            <!--                v-if="required && value.length == 0"-->
            <!--            >-->
            <!--                <i class="mdi mdi-alert-circle mdi-24px"></i>-->
            <!--            </span>-->
            <p
                    class="form-error"
                    v-if="error && value.length == 0"
            >To pole jest wymagane</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'field-input',
        props: {
            value: {
                type: [String, Number],
                required: true
            },
            label: {
                type: String
            },
            error: {
                type: Boolean,
                default: false
            },
            type: {
                type: String,
                default: 'text'
            }
        }
    }
</script>
