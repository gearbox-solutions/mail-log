import{s as p,f as y,d as b,a as v}from"./dayjs.min-DBi-1a5s.js";import{B as h,o as r,c,k,m as i,M as w,q as u,r as $,a,G as o,am as S,D as m,J as x,ap as d}from"./app-rWYSzFGP.js";var _=`
    .p-tag {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: dt('tag.primary.background');
        color: dt('tag.primary.color');
        font-size: dt('tag.font.size');
        font-weight: dt('tag.font.weight');
        padding: dt('tag.padding');
        border-radius: dt('tag.border.radius');
        gap: dt('tag.gap');
    }

    .p-tag-icon {
        font-size: dt('tag.icon.size');
        width: dt('tag.icon.size');
        height: dt('tag.icon.size');
    }

    .p-tag-rounded {
        border-radius: dt('tag.rounded.border.radius');
    }

    .p-tag-success {
        background: dt('tag.success.background');
        color: dt('tag.success.color');
    }

    .p-tag-info {
        background: dt('tag.info.background');
        color: dt('tag.info.color');
    }

    .p-tag-warn {
        background: dt('tag.warn.background');
        color: dt('tag.warn.color');
    }

    .p-tag-danger {
        background: dt('tag.danger.background');
        color: dt('tag.danger.color');
    }

    .p-tag-secondary {
        background: dt('tag.secondary.background');
        color: dt('tag.secondary.color');
    }

    .p-tag-contrast {
        background: dt('tag.contrast.background');
        color: dt('tag.contrast.color');
    }
`,P={root:function(e){var n=e.props;return["p-tag p-component",{"p-tag-info":n.severity==="info","p-tag-success":n.severity==="success","p-tag-warn":n.severity==="warn","p-tag-danger":n.severity==="danger","p-tag-secondary":n.severity==="secondary","p-tag-contrast":n.severity==="contrast","p-tag-rounded":n.rounded}]},icon:"p-tag-icon",label:"p-tag-label"},j=h.extend({name:"tag",style:_,classes:P}),B={name:"BaseTag",extends:p,props:{value:null,severity:null,rounded:Boolean,icon:String},style:j,provide:function(){return{$pcTag:this,$parentInstance:this}}};function s(t){"@babel/helpers - typeof";return s=typeof Symbol=="function"&&typeof Symbol.iterator=="symbol"?function(e){return typeof e}:function(e){return e&&typeof Symbol=="function"&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},s(t)}function z(t,e,n){return(e=M(e))in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function M(t){var e=T(t,"string");return s(e)=="symbol"?e:e+""}function T(t,e){if(s(t)!="object"||!t)return t;var n=t[Symbol.toPrimitive];if(n!==void 0){var l=n.call(t,e);if(s(l)!="object")return l;throw new TypeError("@@toPrimitive must return a primitive value.")}return(e==="string"?String:Number)(t)}var g={name:"Tag",extends:B,inheritAttrs:!1,computed:{dataP:function(){return y(z({rounded:this.rounded},this.severity,this.severity))}}},C=["data-p"];function D(t,e,n,l,Q,f){return r(),c("span",i({class:t.cx("root"),"data-p":f.dataP},t.ptmi("root")),[t.$slots.icon?(r(),k(w(t.$slots.icon),i({key:0,class:t.cx("icon")},t.ptm("icon")),null,16,["class"])):t.icon?(r(),c("span",i({key:1,class:[t.cx("icon"),t.icon]},t.ptm("icon")),null,16)):u("",!0),t.value!=null||t.$slots.default?$(t.$slots,"default",{key:2},function(){return[a("span",i({class:t.cx("label")},t.ptm("label")),o(t.value),17)]}):u("",!0)],16,C)}g.render=D;const N={class:"h-full p-2"},Y={class:"flex w-full flex-col space-y-4"},V={class:"flex-none"},q={class:"flex items-baseline justify-between"},A={class:"mb-4 text-2xl font-bold"},E={class:"text-muted-color text-sm"},O={class:"flex items-center justify-between"},F={class:""},G={class:""},I={class:"text-muted-color text-sm"},J={key:0,class:"flex-none rounded border border-red-200 bg-red-50 p-4"},K={class:"text-red-800"},H={class:"mt-4 flex grow items-stretch overflow-clip rounded-lg"},L=["srcdoc"],W=S({__name:"MailShow",props:{mail:{type:Object,required:!0}},setup(t){return(e,n)=>(r(),c("div",N,[m(d(v),{class:"min-h-full",pt:{body:{class:"grow"},content:{class:"grow  flex items-stretch"}}},{content:x(()=>[a("div",Y,[a("div",V,[a("div",q,[a("h1",A,o(t.mail.subject),1),a("div",E,o(d(b)(t.mail.sent_at).format("MMMM D, YYYY h:mm A")),1)]),a("div",O,[a("div",F,[a("p",G," To: "+o(t.mail.to_name?`${t.mail.to_name} <${t.mail.to_email}>`:t.mail.to_email),1),a("p",I," From: "+o(t.mail.from_name?`${t.mail.from_name} <${t.mail.from_email}>`:t.mail.from_email),1)]),m(d(g),{severity:t.mail.status==="success"?"success":"danger",value:t.mail.status,rounded:""},null,8,["severity","value"])])]),t.mail.error_message?(r(),c("div",J,[a("p",K,o(t.mail.error_message),1)])):u("",!0),a("div",H,[a("iframe",{class:"w-full",srcdoc:t.mail.content_html,frameborder:"0",allowfullscreen:""},null,8,L)])])]),_:1})]))}});export{W as default};
