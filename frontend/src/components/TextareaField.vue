<template>
    <div>
        <label
                class="label"
                v-if="label"
        >{{ label }}</label>
        <div class="control has-icons-right">
            <textarea
                    class="input form-control"
                    v-bind:value="value"
                    v-on:input="$emit('input', $event.target.value)"
                    required
            />
            <p
                    class="form-error"
                    v-if="error && value.length == 0"
            >To pole jest wymagane</p>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'field-textarea',
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
            }
        }
    }
</script>
