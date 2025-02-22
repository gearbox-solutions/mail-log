import{s as u,d as m,a as f}from"./dayjs.min-NtYHfqg0.js";import{B as p,c as r,o as s,D as h,F as i,C as b,m as c,U as v,a as e,N as t,am as y,L as d,R as k,ap as l}from"./app-aQLUJyJ9.js";var w=function(o){var a=o.dt;return`
.p-tag {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: `.concat(a("tag.primary.background"),`;
    color: `).concat(a("tag.primary.color"),`;
    font-size: `).concat(a("tag.font.size"),`;
    font-weight: `).concat(a("tag.font.weight"),`;
    padding: `).concat(a("tag.padding"),`;
    border-radius: `).concat(a("tag.border.radius"),`;
    gap: `).concat(a("tag.gap"),`;
}

.p-tag-icon {
    font-size: `).concat(a("tag.icon.size"),`;
    width: `).concat(a("tag.icon.size"),`;
    height:`).concat(a("tag.icon.size"),`;
}

.p-tag-rounded {
    border-radius: `).concat(a("tag.rounded.border.radius"),`;
}

.p-tag-success {
    background: `).concat(a("tag.success.background"),`;
    color: `).concat(a("tag.success.color"),`;
}

.p-tag-info {
    background: `).concat(a("tag.info.background"),`;
    color: `).concat(a("tag.info.color"),`;
}

.p-tag-warn {
    background: `).concat(a("tag.warn.background"),`;
    color: `).concat(a("tag.warn.color"),`;
}

.p-tag-danger {
    background: `).concat(a("tag.danger.background"),`;
    color: `).concat(a("tag.danger.color"),`;
}

.p-tag-secondary {
    background: `).concat(a("tag.secondary.background"),`;
    color: `).concat(a("tag.secondary.color"),`;
}

.p-tag-contrast {
    background: `).concat(a("tag.contrast.background"),`;
    color: `).concat(a("tag.contrast.color"),`;
}
`)},$={root:function(o){var a=o.props;return["p-tag p-component",{"p-tag-info":a.severity==="info","p-tag-success":a.severity==="success","p-tag-warn":a.severity==="warn","p-tag-danger":a.severity==="danger","p-tag-secondary":a.severity==="secondary","p-tag-contrast":a.severity==="contrast","p-tag-rounded":a.rounded}]},icon:"p-tag-icon",label:"p-tag-label"},x=p.extend({name:"tag",theme:w,classes:$}),B={name:"BaseTag",extends:u,props:{value:null,severity:null,rounded:Boolean,icon:String},style:x,provide:function(){return{$pcTag:this,$parentInstance:this}}},g={name:"Tag",extends:B,inheritAttrs:!1};function j(n,o,a,I,L,O){return s(),r("span",c({class:n.cx("root")},n.ptmi("root")),[n.$slots.icon?(s(),h(v(n.$slots.icon),c({key:0,class:n.cx("icon")},n.ptm("icon")),null,16,["class"])):n.icon?(s(),r("span",c({key:1,class:[n.cx("icon"),n.icon]},n.ptm("icon")),null,16)):i("",!0),n.value!=null||n.$slots.default?b(n.$slots,"default",{key:2},function(){return[e("span",c({class:n.cx("label")},n.ptm("label")),t(n.value),17)]}):i("",!0)],16)}g.render=j;const z={class:"h-full p-2"},S={class:"flex w-full flex-col space-y-4"},C={class:"flex-none"},M={class:"flex items-baseline justify-between"},T={class:"mb-4 text-2xl font-bold"},_={class:"text-muted-color text-sm"},D={class:"flex items-center justify-between"},N={class:""},Y={class:""},V={class:"text-muted-color text-sm"},A={key:0,class:"flex-none rounded border border-red-200 bg-red-50 p-4"},F={class:"text-red-800"},q={class:"mt-4 flex grow items-stretch overflow-clip rounded-lg"},E=["srcdoc"],U=y({__name:"MailShow",props:{mail:{type:Object,required:!0}},setup(n){return(o,a)=>(s(),r("div",z,[d(l(f),{class:"min-h-full",pt:{body:{class:"grow"},content:{class:"grow  flex items-stretch"}}},{content:k(()=>[e("div",S,[e("div",C,[e("div",M,[e("h1",T,t(n.mail.subject),1),e("div",_,t(l(m)(n.mail.sent_at).format("MMMM D, YYYY h:mm A")),1)]),e("div",D,[e("div",N,[e("p",Y," To: "+t(n.mail.to_name?`${n.mail.to_name} <${n.mail.to_email}>`:n.mail.to_email),1),e("p",V," From: "+t(n.mail.from_name?`${n.mail.from_name} <${n.mail.from_email}>`:n.mail.from_email),1)]),d(l(g),{severity:n.mail.status==="success"?"success":"danger",value:n.mail.status,rounded:""},null,8,["severity","value"])])]),n.mail.error_message?(s(),r("div",A,[e("p",F,t(n.mail.error_message),1)])):i("",!0),e("div",q,[e("iframe",{class:"w-full",srcdoc:n.mail.content_html,frameborder:"0",allowfullscreen:""},null,8,E)])])]),_:1})]))}});export{U as default};
