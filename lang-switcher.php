<?php
/**
 * lang-switcher.php
 * Kullanım: <body> açılır açılmaz <?php include 'lang-switcher.php'; ?>
 */
?>

<div id="google_translate_element" style="display:none;"></div>
<script>
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'tr',
      includedLanguages: 'ar,zh-CN,en,fr,de,it,pt,es,tr,uz',
      autoDisplay: false,
    }, 'google_translate_element');
  }
</script>
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<style>
  /* SADECE banner iframe'i gizle — başka hiçbir şeye dokunma */
   /* Banner bar - direkt body altındaki skiptranslate */
  body > div.skiptranslate { display: none !important; }
  iframe.goog-te-banner-frame { display: none !important; }
  body { top: 0 !important; }

  /* Widget */
  #ls{position:fixed;top:20px;right:20px;z-index:2147483647;font-family:'Segoe UI',system-ui,sans-serif;}
  #ls-btn{display:flex;align-items:center;gap:8px;background:rgba(10,10,20,.88);backdrop-filter:blur(14px);border:1px solid rgba(255,255,255,.15);border-radius:50px;padding:8px 16px 8px 10px;cursor:pointer;color:#fff;font-size:14px;font-weight:500;user-select:none;box-shadow:0 4px 20px rgba(0,0,0,.3);min-width:120px;transition:background .2s;}
  #ls-btn:hover{background:rgba(30,30,50,.96);}
  #ls-btn .lf{font-size:20px;}
  #ls-btn .ln{flex:1;}
  #ls-btn .la{width:15px;height:15px;opacity:.6;transition:transform .25s cubic-bezier(.34,1.56,.64,1);}
  #ls.open #ls-btn .la{transform:rotate(180deg);}
  #ls-dd{position:absolute;top:calc(100% + 8px);right:0;background:rgba(10,10,20,.97);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,.1);border-radius:16px;overflow:hidden;min-width:190px;box-shadow:0 16px 48px rgba(0,0,0,.5);opacity:0;transform:translateY(-8px) scale(.97);pointer-events:none;transition:all .22s cubic-bezier(.34,1.56,.64,1);transform-origin:top right;}
  #ls.open #ls-dd{opacity:1;transform:translateY(0) scale(1);pointer-events:all;}
  .lo{display:flex;align-items:center;gap:12px;padding:10px 16px;cursor:pointer;color:rgba(255,255,255,.8);font-size:13.5px;border-bottom:1px solid rgba(255,255,255,.05);transition:all .15s;}
  .lo:last-child{border-bottom:none;}
  .lo:hover{background:rgba(255,255,255,.08);color:#fff;padding-left:20px;}
  .lo.active{background:rgba(99,179,237,.13);color:#63b3ed;}
  .lo .lof{font-size:19px;flex-shrink:0;}
  .lo .lon{flex:1;}
  .lo .lok{width:14px;height:14px;opacity:0;color:#63b3ed;}
  .lo.active .lok{opacity:1;}
  @media(max-width:480px){#ls{top:12px;right:12px;}#ls-dd{min-width:170px;}}
</style>

<!-- SADECE banner iframe + body top'u gizle -->
<script>
  function hideBar(){
    // Banner div
  var bd = document.querySelector('body > div.skiptranslate');
  if(bd) bd.style.setProperty('display','none','important');
  
  // Banner iframe
  var f = document.querySelector('iframe.goog-te-banner-frame');
  if(f) f.style.setProperty('display','none','important');
  
  // Body kayması
  if(document.body) document.body.style.setProperty('top','0px','important');
    }
  }

  // MutationObserver — sadece body[style] ve yeni iframe'leri izle
  var obs=new MutationObserver(function(muts){
    muts.forEach(function(m){
      if(m.type==='attributes'&&m.target===document.body) hideBar();
      m.addedNodes.forEach(function(n){
        if(n.tagName==='IFRAME') hideBar();
      });
    });
  });

  document.addEventListener('DOMContentLoaded',function(){
    hideBar();
    obs.observe(document.body,{
      attributes:true,
      attributeFilter:['style'],
      childList:true,
      subtree:true
    });
  });

  // Güvenlik: ilk 5 saniye için birkaç kez çalıştır
  [200,500,1000,2000,5000].forEach(function(t){ setTimeout(hideBar,t); });
</script>

<!-- HTML -->
<div id="ls">
  <div id="ls-btn" onclick="lsToggle()">
    <span class="lf" id="lf">🇹🇷</span>
    <span class="ln" id="ln">Türkçe</span>
    <svg class="la" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
  </div>
  <div id="ls-dd">
    <div class="lo" data-l="tr"    onclick="lsSet('tr')">   <span class="lof">🇹🇷</span><span class="lon">Türkçe</span>   <svg class="lok" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
    <div class="lo" data-l="en"    onclick="lsSet('en')">   <span class="lof">🇬🇧</span><span class="lon">English</span>   <svg class="lok" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
    <div class="lo" data-l="ar"    onclick="lsSet('ar')">   <span class="lof">🇸🇦</span><span class="lon">العربية</span>    <svg class="lok" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
    <div class="lo" data-l="zh-CN" onclick="lsSet('zh-CN')"><span class="lof">🇨🇳</span><span class="lon">中文</span>       <svg class="lok" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
    <div class="lo" data-l="fr"    onclick="lsSet('fr')">   <span class="lof">🇫🇷</span><span class="lon">Français</span>  <svg class="lok" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
    <div class="lo" data-l="de"    onclick="lsSet('de')">   <span class="lof">🇩🇪</span><span class="lon">Deutsch</span>   <svg class="lok" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
    <div class="lo" data-l="it"    onclick="lsSet('it')">   <span class="lof">🇮🇹</span><span class="lon">Italiano</span>  <svg class="lok" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
    <div class="lo" data-l="pt"    onclick="lsSet('pt')">   <span class="lof">🇵🇹</span><span class="lon">Português</span> <svg class="lok" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
    <div class="lo" data-l="es"    onclick="lsSet('es')">   <span class="lof">🇪🇸</span><span class="lon">Español</span>   <svg class="lok" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
    <div class="lo" data-l="uz"    onclick="lsSet('uz')">   <span class="lof">🇺🇿</span><span class="lon">O'zbekcha</span> <svg class="lok" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg></div>
  </div>
</div>

<script>
var LD={'tr':{f:'🇹🇷',n:'Türkçe'},'en':{f:'🇬🇧',n:'English'},'ar':{f:'🇸🇦',n:'العربية'},'zh-CN':{f:'🇨🇳',n:'中文'},'fr':{f:'🇫🇷',n:'Français'},'de':{f:'🇩🇪',n:'Deutsch'},'it':{f:'🇮🇹',n:'Italiano'},'pt':{f:'🇵🇹',n:'Português'},'es':{f:'🇪🇸',n:'Español'},'uz':{f:'🇺🇿',n:"O'zbekcha"}};

function setCk(n,v,d){var e='';if(d){var dt=new Date();dt.setTime(dt.getTime()+d*864e5);e='; expires='+dt.toUTCString();}document.cookie=n+'='+encodeURIComponent(v)+e+'; path=/';}
function getCk(n){var m=document.cookie.match(new RegExp('(^| )'+n+'=([^;]+)'));return m?decodeURIComponent(m[2]):null;}

function lsUI(lang){
  var d=LD[lang]||LD['tr'];
  document.getElementById('lf').textContent=d.f;
  document.getElementById('ln').textContent=d.n;
  document.querySelectorAll('.lo').forEach(function(el){el.classList.toggle('active',el.getAttribute('data-l')===lang);});
}

function lsToggle(){document.getElementById('ls').classList.toggle('open');}
function lsClose(){document.getElementById('ls').classList.remove('open');}
document.addEventListener('click',function(e){if(!document.getElementById('ls').contains(e.target))lsClose();});

function lsSet(lang){
  // Cookie'yi yaz ve sayfayı yenile — en güvenilir yöntem
  setCk('googtrans','/tr/'+lang,30);
  // Subdomain için de yaz
  var host=location.hostname;
  if(host.indexOf('.')!==-1){
    document.cookie='googtrans='+encodeURIComponent('/tr/'+lang)+'; path=/; domain=.'+host.split('.').slice(-2).join('.');
  }
  lsUI(lang);
  lsClose();
  location.reload();
}

// Başlangıçta aktif dili oku
(function(){
  var c=getCk('googtrans'),lang='tr';
  if(c){var p=c.split('/');if(p.length===3&&LD[p[2]])lang=p[2];}
  lsUI(lang);
})();
</script>
