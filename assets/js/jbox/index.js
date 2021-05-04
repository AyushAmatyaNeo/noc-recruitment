$(document).ready(function(){
    new jBox('Modal', {
        width: 300,
        height: 100,
        attach: '#amount',
        title: 'Esewa Payment',
        content: '<i>You have already paid the Amount!</i>'
      });
      new jBox('Modal', {
        width: 300,
        height: 100,
        attach: '.admitCard',
        title: 'Payment is pending',
        content: '<i>You have not paid Application Fee, please pay to print Admit Card!</i>'
      });
});