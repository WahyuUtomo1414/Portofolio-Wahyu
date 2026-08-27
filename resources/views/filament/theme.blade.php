<style>
    :root {
        --portfolio-primary-950: #0b2545;
        --portfolio-primary-800: #123c69;
        --portfolio-secondary-700: #2563eb;
        --portfolio-accent-500: #14b8a6;
        --portfolio-surface-tint: #eef6ff;
    }

    html.fi,
    html.fi.dark {
        color-scheme: light;
    }

    .fi-topbar {
        background-image: linear-gradient(
            to right,
            var(--portfolio-primary-950) 0,
            var(--portfolio-primary-950) 20rem,
            #ffffff 20rem,
            #ffffff 100%
        );
    }

    .fi-topbar-start,
    .fi-topbar-start a,
    .fi-topbar-start .fi-logo,
    .fi-topbar-start .fi-logo * {
        color: #ffffff !important;
        fill: currentColor;
    }

    .fi-topbar .fi-icon-btn,
    .fi-topbar .fi-topbar-open-sidebar-btn,
    .fi-topbar .fi-topbar-close-sidebar-btn {
        color: #ffffff;
    }

    .fi-sidebar,
    .fi-sidebar-header-ctn,
    .fi-sidebar-header,
    .fi-sidebar-nav,
    .fi-sidebar-footer {
        background: var(--portfolio-primary-950) !important;
    }

    .fi-sidebar-header-logo-ctn,
    .fi-sidebar-header-logo-ctn a,
    .fi-sidebar-header-logo-ctn .fi-logo,
    .fi-sidebar-header-logo-ctn .fi-logo * {
        color: #ffffff !important;
        fill: currentColor;
    }

    .fi-sidebar-group-label,
    .fi-sidebar-item-label,
    .fi-sidebar-item-btn,
    .fi-sidebar-group-btn,
    .fi-sidebar-group-collapse-btn,
    .fi-sidebar-group-dropdown-trigger-btn,
    .fi-sidebar-item-icon,
    .fi-sidebar-group svg,
    .fi-sidebar-item svg,
    .fi-sidebar-open-collapse-sidebar-btn,
    .fi-sidebar-close-collapse-sidebar-btn {
        color: #ffffff !important;
        stroke: currentColor;
    }

    .fi-sidebar-group-label {
        color: rgba(226, 232, 240, 0.78) !important;
    }

    .fi-sidebar-group-btn,
    .fi-sidebar-item-btn,
    .fi-sidebar-group-dropdown-trigger-btn {
        border-radius: 0.75rem;
    }

    .fi-sidebar-item-btn:hover,
    .fi-sidebar-group-btn:hover,
    .fi-sidebar-group-dropdown-trigger-btn:hover,
    .fi-sidebar-item.fi-active .fi-sidebar-item-btn,
    .fi-sidebar-item.fi-sidebar-item-has-active-child-items .fi-sidebar-item-btn {
        background: rgba(255, 255, 255, 0.12) !important;
    }

    .fi-sidebar-item.fi-active .fi-sidebar-item-btn,
    .fi-sidebar-item.fi-sidebar-item-has-active-child-items .fi-sidebar-item-btn {
        box-shadow: inset 3px 0 0 var(--portfolio-accent-500);
    }

    .fi-btn.fi-color-primary:not(.fi-outlined),
    .fi-ac .fi-btn.fi-color-primary:not(.fi-outlined),
    .fi-modal .fi-btn.fi-color-primary:not(.fi-outlined) {
        background: var(--portfolio-primary-800) !important;
        border-color: var(--portfolio-primary-800) !important;
        color: #ffffff !important;
    }

    .fi-btn.fi-color-primary:not(.fi-outlined):hover,
    .fi-ac .fi-btn.fi-color-primary:not(.fi-outlined):hover,
    .fi-modal .fi-btn.fi-color-primary:not(.fi-outlined):hover {
        background: var(--portfolio-secondary-700) !important;
        border-color: var(--portfolio-secondary-700) !important;
        color: #ffffff !important;
    }

    .fi-btn.fi-color-primary.fi-outlined {
        border-color: var(--portfolio-primary-800) !important;
        color: var(--portfolio-primary-800) !important;
    }

    .fi-icon-btn.fi-color-primary,
    .fi-link.fi-color-primary {
        color: var(--portfolio-primary-800) !important;
    }

    .fi-badge.fi-color-primary {
        background: var(--portfolio-surface-tint) !important;
        color: var(--portfolio-primary-800) !important;
    }

    @media (max-width: 1024px) {
        .fi-topbar {
            background: #ffffff;
        }

        .fi-topbar-start,
        .fi-topbar .fi-icon-btn,
        .fi-topbar .fi-topbar-open-sidebar-btn,
        .fi-topbar .fi-topbar-close-sidebar-btn {
            color: inherit;
        }
    }
</style>
