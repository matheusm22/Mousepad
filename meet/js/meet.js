'use strict';
const closeModalButton = document.querySelector('#close-modal');
const modal = document.querySelector('#modal');
const fade = document.querySelector('#fade');

const toggleModal = () => {
   [modal, fade].forEach((el) => el.classList.toggle("hide"));

};

[closeModalButton, fade].forEach((el) => {
   el.addEventListener('click', () => toggleModal());
});

function copiarTexto() {
// função copiar
   var range = document.createRange();
   range.selectNode(document.getElementById('res')); //changed here
   window.getSelection().removeAllRanges();
   window.getSelection().addRange(range);
   document.execCommand("copy");
   window.getSelection().removeAllRanges();
// mensagem para usuário
   res.innerHTML = `Link copiado! carregando...`;
// redirecionamento para o zimbra   
   setTimeout(function() {
    window.location.href = "https://email.econeteditora.com.br/#1";
}, 1500);

}




//   ABRIR CASO O PHP PARE DE FUNCIONAR, TRANSFORME-O EM JS E FAÇA AS ATUALIZAÇÕES
//  function gerar() {

//    var nome = document.getElementById('nome');

//    switch (nome.value) {

//       case 'matheus':
//       case 'matheus_mello':
//       case 'Matheus':

//          var link = ['https://meet.google.com/jxg-ftrm-qqe', 'https://meet.google.com/kef-pqqe-cew']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'jannis_fernandes':

//          var link = ['https://meet.google.com/kdj-nqqb-onf', 'https://meet.google.com/xdz-hiaf-fnq']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'maurianny_baena':

//          var link = ['https://meet.google.com/jag-vjfo-oin', 'https://meet.google.com/svw-zaxw-cvz']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'ana_crus':

//          var link = ['https://meet.google.com/hcd-ddpu-hup', 'https://meet.google.com/nft-avjr-ggn']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'samara_santos1':

//          var link = ['https://meet.google.com/tkk-upft-vva', 'https://meet.google.com/vkk-qjxn-uwt']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;


//       case 'kailani_ribeiro':

//          var link = ['https://meet.google.com/hby-zuwc-qmn', 'https://meet.google.com/feq-tooj-vbu']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'leonardo_winter':

//          var link = ['https://meet.google.com/nyz-cuhd-mbx', 'https://meet.google.com/drj-ifuc-hxt']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'ketruin_rodrigues':

//          var link = ['https://meet.google.com/oht-riri-ewo', 'https://meet.google.com/nuj-ytos-ywr']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'juan_lima':

//          var link = ['https://meet.google.com/mmj-fxrw-aqy', 'https://meet.google.com/yvo-uxxi-wdt']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'thalia_gernhard':

//          var link = ['https://meet.google.com/xcw-ergv-dyj', 'https://meet.google.com/fpn-jbhk-avs']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'flaviane':

//          var link = ['https://meet.google.com/thr-ktrz-ctg', 'https://meet.google.com/eug-doqr-ecf']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'jaqueline_motta':

//          var link = ['https://meet.google.com/sxv-oeoo-hry', 'https://meet.google.com/vah-nqte-jgk']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'dafni_correa':

//          var link = ['https://meet.google.com/hve-soxi-qiv', 'https://meet.google.com/mha-dywr-byt']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;

//          break;

//       case 'kayke_fuckner':

//          var link = ['https://meet.google.com/mmy-eyrw-gtr', 'https://meet.google.com/mqv-vhkr-mqg']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'daniele_freitas':

//          var link = ['https://meet.google.com/vai-joat-wtd', 'https://meet.google.com/omf-rnur-dkm']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;


//       case 'bruna_heloisa':

//          var link = ['https://meet.google.com/fqc-xunz-bhq', 'https://meet.google.com/dwn-qjgi-qoy']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'cecilia_junco':

//          var link = ['https://meet.google.com/uqx-oofi-ogt', 'https://meet.google.com/gzf-jggh-yvu']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;


//       case 'wesley_borges':

//          var link = ['https://meet.google.com/knu-mosh-cnd', 'https://meet.google.com/ffr-ayer-pmh']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'graziela_izenpon':

//          var link = ['https://meet.google.com/sjq-qbpa-wtb', 'https://meet.google.com/arp-syek-qnw']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;


//       case 'bruna_guimaraes':

//          var link = ['https://meet.google.com/ngq-zsqs-tcf', 'https://meet.google.com/bgh-rxcw-tuw']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'sheyla_matos':

//          var link = ['https://meet.google.com/kek-dasj-evw', 'https://meet.google.com/sht-nxfc-nye']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'vitor_spada':

//          var link = ['https://meet.google.com/ikg-uvxb-phi', 'https://meet.google.com/yby-eddx-utw']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'shirlei_santos':

//          var link = ['https://meet.google.com/qec-fzhy-jjq', 'https://meet.google.com/pke-hcqd-uwc']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'x':

//          var link = ['https://meet.google.com/skm-gesr-cwp', 'https://meet.google.com/qio-sjqh-ast']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'luiz_jorge':

//          var link = ['https://meet.google.com/xhd-tksy-zwq', 'https://meet.google.com/xmq-tvyw-bea']
//          var elemento = link[Math.floor(Math.random() * link.length)

//          res.innerHTML = elemento;
//          break;

//       case 'loana_soares':

//          var link = ['https://meet.google.com/yje-dsjg-qmq', 'https://meet.google.com/yzp-gixb-frt']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'kaike_fuckner':

//          var link = ['https://meet.google.com/get-frux-eah', 'https://meet.google.com/ajm-dyco-ins']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'jessica_silva1':

//          var link = ['https://meet.google.com/jbi-ymgj-chq', 'https://meet.google.com/qvr-eztt-tox']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'iosef_orona':

//          var link = ['https://meet.google.com/zdu-fydh-mpj', 'https://meet.google.com/dvj-wxfx-ojy']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'simone_dias':

//          var link = ['https://meet.google.com/fig-vjxg-rgr', 'https://meet.google.com/rum-uyem-qnn']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;


//       case 'hannely_santos':

//          var link = ['https://meet.google.com/kqa-rnix-ruh', 'https://meet.google.com/nen-sbrk-reb']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'bruna_hazure':

//          var link = ['https://meet.google.com/mjv-jmka-apu', 'https://meet.google.com/cdj-phpc-xwt']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'larissa':

//          var link = ['https://meet.google.com/bxd-mqks-qzp', 'https://meet.google.com/nwf-cmba-jvi']
//          var elemento = link[Math.floor(Math.random() * link.length)]

//          res.innerHTML = elemento;
//          break;

//       case 'x':

//          var link = ['https://meet.google.com/hpm-bpai-kpn', 'https://meet.google.com/ifd-kipk-xor']
//          var elemento = link[Math.floor(Math.random() * link.length)]
   
//          res.innerHTML = elemento;
//          break;


//       default:
//          alert('Usuário inválido');
//          location.reload();
//          break;

//    }

// }







