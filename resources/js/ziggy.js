const Ziggy = {"url":"http:\/\/projecttest.test","port":null,"defaults":{},"routes":{"contacts":{"uri":"contact","methods":["GET","HEAD"]},"add-contact":{"uri":"ajout","methods":["GET","HEAD"]},"send-contact":{"uri":"ajout","methods":["POST"]},"edit-contact":{"uri":"edit\/{id}","methods":["GET","HEAD"],"wheres":{"id":"[0-9]+"}}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}

export { Ziggy };
