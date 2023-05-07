<?php
namespace Ratchet\Http;
use Ratchet\AbstractMessageComponentTestCase;

/**
 * @covers Ratchet\Http\OriginCheck
 */
class OriginCheckTest extends AbstractMessageComponentTestCase {
    protected $_reqStub;

    public function setUp() {
        $this->_reqStub = $this->getMock('Psr\Http\Message\RequestInterface');
        $this->_reqStub->expects($this->any())->method('getHeader')->will($this->returnValue(['40.115.0.66']));

        parent::setUp();

        $this->_serv->allowedOrigins[] = '40.115.0.66';
    }

    protected function doOpen($conn) {
        $this->_serv->onOpen($conn, $this->_reqStub);
    }

    public function getConnectionClassString() {
        return '\Ratchet\ConnectionInterface';
    }

    public function getDecoratorClassString() {
        return '\Ratchet\Http\OriginCheck';
    }

    public function getComponentClassString() {
        return '\Ratchet\Http\HttpServerInterface';
    }

    public function testCloseOnNonMatchingOrigin() {
        $this->_serv->allowedOrigins = ['socketo.me'];
        $this->_conn->expects($this->once())->method('close');

        $this->_serv->onOpen($this->_conn, $this->_reqStub);
    }

    public function testOnMessage() {
        $this->passthroughMessageTest('Hello World!');
    }
}
