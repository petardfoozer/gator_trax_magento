
window.onscroll = function() 
{
    // get percentage
    console.log(getScrollXY());
    console.log(getDocHeight());
    console.log(getDocVScrollPercent());
    console.log('=============');
};

function getDocHeight()
{
    var body = document.body,
        html = document.documentElement;

    var height = Math.max(body.scrollHeight, body.offsetHeight, 
        html.clientHeight, html.scrollHeight, html.offsetHeight);
        
    return height;
}

function getDocVScrollPercent()
{
    var percent         = 0,
        height          = getDocHeight(), 
        vScrollPosish   = getScrollXY()[1];

        return (vScrollPosish/height) * 100;
}

function getScrollXY() 
{
    var x = 0, y = 0;
    if( typeof(window.pageYOffset) == 'number') 
    {   
            // Netscape
        x = window.pageXOffset;
        y = window.pageYOffset;
    } else if( document.body && (document.body.scrollLeft || document.body.scrollTop)) 
    {
            // DOM
        x = document.body.scrollLeft;
        y = document.body.scrollTop;
    } else if( document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop)) 
    {
            // IE6 standards compliant mode
        x = document.documentElement.scrollLeft;
        y = document.documentElement.scrollTop;
    }
    return [x, y];
}