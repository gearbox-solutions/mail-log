import gbxConfig from "@gearbox-solutions/eslint-config-gbx";

export default [
    ...gbxConfig,
    // add additional configurations here
    {
        // rules: {
        //     "vue/attribute-hyphenation": ["error", "never", {
        //         "ignore": []
        //     }]
        // }
        rules: {
            "vue/multi-word-component-names": [
                "error",
                {
                    ignores: ["Banner", "Dropdown", "Modal", "Login", "Register", "Dashboard", "Show", "Welcome", "Checkbox"],
                },
            ],
        },
    },
];
