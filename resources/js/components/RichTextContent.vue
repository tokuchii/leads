<template>
    <div class="rich-text-wrapper max-w-full min-w-0">
        <p v-if="isPreview" class="whitespace-pre-line break-words">{{ previewText }}</p>
        <div
            v-else-if="isHtml"
            class="rich-text-content ql-editor"
            :class="{ 'inherit-color': inheritColor }"
            v-html="content"
        ></div>
        <ul
            v-else-if="legacyList.length"
            class="list-disc list-outside pl-4 space-y-1"
        >
            <li v-for="(item, idx) in legacyList" :key="idx">{{ item }}</li>
        </ul>
        <p v-else-if="plainText" class="whitespace-pre-line">{{ plainText }}</p>
    </div>
</template>

<script>
export default {
    name: 'RichTextContent',
    props: {
        content: {
            type: [String, Array],
            default: '',
        },
        maxLength: {
            type: Number,
            default: 0,
        },
        inheritColor: {
            type: Boolean,
            default: false,
        },
    },
    computed: {
        isHtml() {
            if (typeof this.content !== 'string') {
                return false;
            }
            return /<[^>]+>/.test(this.content);
        },
        isPreview() {
            return this.maxLength > 0;
        },
        previewText() {
            let text = '';

            if (this.isHtml) {
                text = this.stripHtml(this.content);
            } else if (Array.isArray(this.content)) {
                text = this.content.map(item => String(item).trim()).filter(Boolean).join(', ');
            } else if (typeof this.content === 'string') {
                text = this.content.trim();
            }

            if (!text) {
                return '';
            }

            if (text.length > this.maxLength) {
                return `${text.slice(0, this.maxLength)}...`;
            }

            return text;
        },
        legacyList() {
            if (this.isHtml) {
                return [];
            }
            if (Array.isArray(this.content)) {
                return this.content.map(item => String(item).trim()).filter(Boolean);
            }
            if (typeof this.content !== 'string') {
                return [];
            }
            const trimmed = this.content.trim();
            if (!trimmed) {
                return [];
            }
            if (trimmed.includes(',')) {
                return trimmed.split(',').map(item => item.trim()).filter(Boolean);
            }
            if (trimmed.includes('\n')) {
                return trimmed.split('\n').map(item => item.trim()).filter(Boolean);
            }
            return [trimmed];
        },
        plainText() {
            if (this.isHtml || this.legacyList.length) {
                return '';
            }
            if (typeof this.content === 'string') {
                return this.content.trim();
            }
            return '';
        },
    },
    methods: {
        stripHtml(html) {
            const element = document.createElement('div');
            element.innerHTML = html;
            return (element.textContent || element.innerText || '')
                .replace(/\s+/g, ' ')
                .trim();
        },
    },
};
</script>

<style scoped>
.rich-text-wrapper {
    max-width: 100%;
    min-width: 0;
    overflow-wrap: anywhere;
    word-break: break-word;
}

.rich-text-content {
    word-break: break-word;
    overflow-wrap: anywhere;
}

.rich-text-content.inherit-color,
.rich-text-content.inherit-color :deep(*) {
    color: inherit;
}

.rich-text-content :deep(strong),
.rich-text-content :deep(b) {
    font-weight: 700;
}

.rich-text-content :deep(em),
.rich-text-content :deep(i) {
    font-style: italic;
}

.rich-text-content :deep(u) {
    text-decoration: underline;
}

.rich-text-content :deep(s),
.rich-text-content :deep(strike),
.rich-text-content :deep(del) {
    text-decoration: line-through;
}

.rich-text-content :deep(.ql-align-center),
.rich-text-content :deep([style*="text-align: center"]) {
    text-align: center;
}

.rich-text-content :deep(.ql-align-right),
.rich-text-content :deep([style*="text-align: right"]) {
    text-align: right;
}

.rich-text-content :deep(.ql-align-justify),
.rich-text-content :deep([style*="text-align: justify"]) {
    text-align: justify;
}

.rich-text-content :deep(ul),
.rich-text-content :deep(ol) {
    padding-left: 1.5rem;
    margin-bottom: 0.5rem;
}

.rich-text-content :deep(ul) {
    list-style-type: disc;
}

.rich-text-content :deep(ol) {
    list-style-type: decimal;
}

.rich-text-content :deep(li[data-list="bullet"]) {
    list-style-type: disc;
}

.rich-text-content :deep(li[data-list="ordered"]) {
    list-style-type: decimal;
}

.rich-text-content :deep(li) {
    margin-bottom: 0.25rem;
    display: list-item;
}

.rich-text-content :deep(.ql-ui) {
    display: none;
}

.rich-text-content :deep(p) {
    margin-bottom: 0.5rem;
}

.rich-text-content :deep(p:last-child),
.rich-text-content :deep(ul:last-child),
.rich-text-content :deep(ol:last-child) {
    margin-bottom: 0;
}
</style>
